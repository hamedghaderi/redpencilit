<?php

namespace Tests\Unit;

use App\Reply;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function it_has_an_owner()
    {
        $this->makeAdmin();
        
        $reply = factory(Reply::class)->create();
        
        $this->assertInstanceOf(User::class, $reply->owner);
    }
    
    /** @test * */
    public function it_belongs_to_a_ticket()
    {
        $this->makeAdmin();
        
        $reply = factory(Reply::class)->create();
        
        $this->assertInstanceOf(Ticket::class, $reply->ticket);
    }
}
