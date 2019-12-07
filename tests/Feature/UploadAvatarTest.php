<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadAvatarTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function only_members_can_add_avatar() 
    {
       $this->json('POST', route('avatar.store', [app()->getLocale(), 1]))
           ->assertStatus(401);
    }

    /** @test **/
    public function an_authenticated_user_can_upload_an_avatar()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

       $user = $this->signIn();

       $file = UploadedFile::fake()->image('avatar.jpg');

       $this->json('POST', route('avatar.store', [app()->getLocale(), $user->id]), [
           'avatar' => $file
       ]);

       Storage::disk('public')->assertExists('avatars/' . $file->hashName());

       $this->assertDatabaseHas('users', ['avatar' => 'avatars/' . $file->hashName()]);
    }

    /** @test **/
    public function an_avatar_should_be_in_proper_format()
    {
        $user = $this->signIn();

        $this->json('POST', route('avatar.store', [app()->getLocale(), $user->id]), [
            'avatar' => 'not an image'
        ])->assertStatus(422);
    }
}
