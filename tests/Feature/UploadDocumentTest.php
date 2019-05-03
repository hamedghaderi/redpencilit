<?php

namespace Tests\Feature;

use App\DocumentDraft;
use App\User;
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
       $user = $this->signIn();

       Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx'),
        ];

        $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

       Storage::disk('local')
            ->assertExists('documents/' . $files[0]->hashName())
            ->assertExists('documents/' . $files[1]->hashName());

       $documents = $user->documents->all();

       $this->assertEquals($documents[0]->path, 'documents/' . $files[0]->hashName());
       $this->assertEquals($documents[1]->path, 'documents/' . $files[1]->hashName());

       $this->assertDatabaseHas('document_drafts', ['path' => $documents[0]->path]);
       $this->assertDatabaseHas('document_drafts', ['path' => $documents[1]->path]);
   }

   /** @test **/
   public function guests_cannot_upload_documents()
   {
       $this->json('post', '/users/1/documents', [])->assertStatus(401);

       $this->post('/users/1/documents', [])->assertRedirect('login');
   }

   /** @test **/
   public function an_authenticated_user_cannot_upload_files_for_other_users()
   {
       $user = $this->signIn();

       $otherUser = factory(User::class)->create();

       Storage::fake('local');

       $files = [
           UploadedFile::fake()->create('document1.docx'),
           UploadedFile::fake()->create('document2.docx'),
       ];

       $this->json('post', '/users/' . $otherUser->username . '/documents', [
           'articles' => $files
       ])->assertStatus(403);
   }


    /** @test **/
    public function a_user_can_upload_a_single_document()
    {
        Storage::fake('local');

        $user = $this->signIn();

        $files = [
            UploadedFile::fake()->create('document1.docx')
        ];

        $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $document = DocumentDraft::first();

        $this->assertEquals($document->path, 'documents/' . $files[0]->hashName());
    }

    /** @test **/
    public function a_document_should_not_be_empty()
    {
        $files = [];

        $user = $this->signIn();

        $response = $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $response->assertStatus(400);
    }

    /** @test **/
    public function documents_should_be_in_valid_formats_of_doc_or_docx()
    {
        $user = $this->signIn();

        $files = [
            UploadedFile::fake()->create('document1.img')
        ];

        $response = $this->json('POST', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $response->assertStatus(400);
    }

    /** @test **/
    public function when_uploading_new_documents_previous_ones_recent_becomes_false()
    {
        $user = $this->signIn();

        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
            UploadedFile::fake()->create('document2.docx')
        ];

        $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $documents = $user->documents->all();


        $this->assertTrue($documents[0]->recent);
        $this->assertTrue($documents[1]->recent);

        $files = [
            UploadedFile::fake()->create('document2.docx')
        ];

        $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $documents = $user->fresh()->documents;

        $this->assertFalse($documents[0]->recent);
        $this->assertFalse($documents[1]->recent);
        $this->assertTrue($documents[2]->recent);
    }
}
