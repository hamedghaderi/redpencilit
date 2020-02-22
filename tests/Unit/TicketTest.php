<?php

namespace Tests\Unit;

use App\Post;
use App\Ticket;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends \Tests\TestCase
{
    
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->makeAdmin();
    }
    
    /** @test * */
    public function it_has_an_owner()
    {
        $ticket = create(Ticket::class);
        
        $this->assertInstanceOf(User::class, $ticket->owner);
    }
    
    /** @test * */
    public function it_may_have_many_replies()
    {
        $ticket = factory(Ticket::class)->create();
        
        $this->assertInstanceOf(Collection::class, $ticket->replies);
    }
}
