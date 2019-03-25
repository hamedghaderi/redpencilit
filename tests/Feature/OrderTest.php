<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Cache;
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
}
