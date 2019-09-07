<?php

namespace Tests\Feature;

use App\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadBlogImageTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function admin_can_upload_images_for_its_blog_posts()
    {
        Storage::fake('blog');
        
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $this->postJson('/post-attachments', [
            'attachment' =>  $file = UploadedFile::fake()->image('test.jpg'),
            'key' => 'image.jpg'
        ])->assertStatus(200);
        
        Storage::disk('public')->assertExists('blog/image.jpg');
        
        Storage::disk('public')->delete('blog/image.jpg');
    }
    
    /** @test **/
    public function image_should_be_in_valid_format()
    {
       Storage::fake('blog');
    
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
    
        $user->addRole($role);
    
        $this->postJson('/post-attachments', [
            'attachment' =>  $file = UploadedFile::fake()->create('test.docx'),
            'key' => 'image.jpg'
        ])->assertJson(['errors' => [
            'attachment' => [
                0 => 'فایل ضمیمه شده باید حتما عکس باشد.'
            ]
        ]]);
    }
    
    /** @test **/
    public function an_image_requires_a_key_name()
    {
       Storage::fake('blog');
    
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
    
        $user->addRole($role);
    
        $this->postJson('/post-attachments', [
            'attachment' =>  $file = UploadedFile::fake()->create('test.docx'),
        ])->assertSeeText('errors');
    }
}
