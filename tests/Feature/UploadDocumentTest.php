<?php

namespace Tests\Feature;

use App\DocumentDraft;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadDocumentTest extends TestCase
{
    use RefreshDatabase;

   /** @test **/
   public function a_user_can_upload_multiple_documents()
   {
       $this->withoutMiddleware();

       Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx'),
        ];

        $this->call('POST',
            '/api/documents',
            [],
            ['temporary_user' => 'afdsfadf'],
            ['articles' => $files],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ]
        );

       Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName())
            ->assertExists('documents/' . $files[1]->hashName());

       $this->assertDatabaseHas('document_drafts', [
            'path' => 'documents/' . $files[0]->hashName(),
            'path' => 'documents/' . $files[1]->hashName(),
        ]);
   }


    /** @test **/
    public function a_user_can_upload_a_single_document()
    {
        $this->withoutMiddleware();

        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx')
        ];

        $response = $this->call('POST',
            '/api/documents',
            [],
            ['temporary_user' => 'afdsfadf'],
            ['articles' => $files],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ]
        );

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
    public function when_uploading_new_documents_previous_ones_recent_becomes_false()
    {
        $this->withoutMiddleware();

        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx')
        ];

        $response = $this->call('POST',
            '/api/documents',
            [],
            ['temporary_user' => 'afdsfadf'],
            ['articles' => $files],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ]
        );

        $documents = DocumentDraft::all();

        $this->assertTrue($documents[0]->recent);
        $this->assertTrue($documents[1]->recent);

        $files = [
            UploadedFile::fake()->create('document2.docx')
        ];

        $response = $this->call('POST',
            '/api/documents',
            [],
            ['temporary_user' => 'afdsfadf'],
            ['articles' => $files],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ]
        );

        $documents = DocumentDraft::all();


        $this->assertFalse($documents[0]->recent);
        $this->assertFalse($documents[1]->recent);
        $this->assertTrue($documents[2]->recent);
    }
}
