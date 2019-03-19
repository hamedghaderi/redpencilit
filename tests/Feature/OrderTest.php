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
       $this->withExceptionHandling();
       Storage::fake('local');

        $user = factory(User::class)->create();

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx'),
        ];

       $this->json('POST', '/api/users/' . $user->id .'/documents', [
            'articles' => $files
        ]);


        Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName())
            ->assertExists('documents/' . $files[1]->hashName());

        $this->assertCount(2, Cache::get('upload_file_paths'));

   }

    /** @test **/
    public function a_user_can_upload_a_single_document()
    {
        $this->withoutExceptionHandling();

        Storage::fake('local');

        $user = factory(User::class)->create();

        $files = [
            UploadedFile::fake()->create('document1.docx')
        ];

        $response = $this->json('POST', '/api/users/' . $user->id .'/documents', [
            'articles' => $files
        ]);

        Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName());

        $this->assertCount(1, Cache::get('upload_file_paths'));
    }

    /** @test **/
    public function a_document_should_not_be_empty()
    {
        $user = factory(User::class)->create();

        $files = [];

        $response = $this->json('post', '/api/users/' . $user->id .'/documents', [
            'articles' => $files
        ])->json();

        $this->assertArrayHasKey('articles', $response['errors']);
    }

    /** @test **/
    public function documents_should_be_in_valid_formats_of_doc_or_docx()
    {
        $user = factory(User::class)->create();

        $files = [
            UploadedFile::fake()->create('document1.img')
        ];

        $response = $this->json('POST', '/api/users/' . $user->id .'/documents', [
            'articles' => $files
        ])->json();

        $this->assertArrayHasKey('articles.0', $response['errors']);
    }

    public function an_uploaded_document_may_save_to_database()
    {
        $user = factory(User::class)->create();

        $files = [
            UploadedFile::fake()->create('document1.docx')
        ];

        $this->json('POST', '/api/users/' . $user->id .'/documents', [
            'articles' => $files
        ])->json();
    }
}
