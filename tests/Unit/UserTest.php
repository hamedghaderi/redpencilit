<?php

namespace Tests\Unit;

use App\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_has_many_settings()
    {
       $user = $this->signIn();

       factory(Setting::class)->create(['owner_id' => $user->id]);

       $this->assertInstanceOf(Setting::class, $user->setting);
    }

    /** @test **/
    public function a_user_has_a_document()
    {
        $user = $this->signIn();

        Storage::fake('local');

        $files = [
            UploadedFile::fake()->create('document1.docx'),
        ];

        $this->json('post', '/users/' . $user->username . '/documents', [
            'articles' => $files
        ]);

        $this->assertInstanceOf(Collection::class, $user->documents);
    }

    /** @test **/
    public function a_user_may_set_many_services()
    {
       $user = $this->signIn();

       $this->assertInstanceOf(Collection::class, $user->services);
    }
}
