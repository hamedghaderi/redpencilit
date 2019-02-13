<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class OrderTest extends TestCase
{
    /** @test **/
    public function a_user_can_upload_documents()
    {
        Storage::fake('public');

        $this->json('POST', '/orders', [
            'document' => $file = UploadedFile::fake()->create('document.docx', 1000) 
        ]);

        Storage::disk('public')->assertExists('docs/' . $file->hashName());
    }
}
