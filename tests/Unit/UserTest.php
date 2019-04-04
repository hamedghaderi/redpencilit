<?php

namespace Tests\Unit;

use App\Setting;
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
}
