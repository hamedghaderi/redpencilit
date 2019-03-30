<?php

namespace Tests\Feature;

use App\Delivery;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class OrderTest extends TestCase
{
    use RefreshDatabase;

   /** @test **/
   public function a_user_can_upload_multiple_documents()
   {
       Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx'),
        ];

       $response = $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);


       Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName())
            ->assertExists('documents/' . $files[1]->hashName());

       $response->assertStatus(200);

       $this->assertDatabaseHas('document_drafts', [
            'path' => 'documents/' . $files[0]->hashName(),
        ]);

       $this->assertDatabaseHas('document_drafts', [
            'path' => 'documents/' . $files[1]->hashName(),
        ]);
   }

    /** @test **/
    public function a_user_can_upload_a_single_document()
    {
        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx')
        ];

        $response = $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);

        Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName());

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_document_should_not_be_empty()
    {
        $files = [];

        $response = $this->json('post', '/api/documents', [
            'articles' => $files
        ]);

        $response->assertStatus(400);
    }

    /** @test **/
    public function documents_should_be_in_valid_formats_of_doc_or_docx()
    {
        $files = [
            UploadedFile::fake()->create('document1.img')
        ];

        $response = $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);

        $response->assertStatus(400);
    }

    /** @test **/
    public function a_delivery_date_has_been_registered_for_user_per_order()
    {
        $this->withoutExceptionHandling();

        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx'),
        ];

        $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);

        $deliveries = Delivery::first();

        $this->assertEquals(
            Carbon::now()->addWeeks(1)->toDateTimeString(),
            $deliveries->deliver_date
        );

        $this->assertEquals(2, $deliveries->limit);

        $files = [
            UploadedFile::fake()->create('document3.docx'),
            UploadedFile::fake()->create('document4.docx'),
        ];

        $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);

        $deliveries = Delivery::first();

        $this->assertEquals(4, $deliveries->limit);

        $files = [
            UploadedFile::fake()->create('document5.docx'),
            UploadedFile::fake()->create('document6.docx'),
        ];

        $this->json('POST', '/api/documents', [
            'articles' => $files
        ]);

        $deliveries = Delivery::all()[1];

        $this->assertEquals(2, $deliveries->limit);
    }
}
