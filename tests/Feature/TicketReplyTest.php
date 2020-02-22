<?php

namespace Tests\Feature;

use App\Reply;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketReplyTest extends TestCase
{
    
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->makeAdmin();
    }
    
    /** @test * */
    public function a_user_can_add_reply_to_his_ticket()
    {
        $this->withoutExceptionHandling();
        
        $ticket = factory(Ticket::class)->create();
        
        $user = $this->signIn($ticket->owner);
        
        $this->post(route('replies.store', [app()->getLocale(), $ticket->id]), [
            'body' => 'My Reply'
        ]);
        
        $this->assertDatabaseHas('replies', [
            'body' => 'My Reply',
            'ticket_id' => $ticket->id,
            'owner_id' => $user->id
        ]);
    }
    
    /** @test * */
    public function a_reply_requires_body()
    {
        $ticket = factory(Ticket::class)->create();
        
        $this->post(route('replies.store', [app()->getLocale(), $ticket->id]))
            ->assertSessionHasErrors(['body']);

        $this->assertDatabaseMissing('replies', [
            'body' => 'My Reply',
            'ticket_id' => $ticket->id,
            'owner_id' => auth()->id()
        ]);
    }
    
    /** @test **/
    public function a_body_most_be_at_least_5_characters()
    {
        $ticket = factory(Ticket::class)->create();
    
        $this->post(route('replies.store', [app()->getLocale(), $ticket->id]), [
            'body' => 'hell'
        ])->assertSessionHasErrors(['body']);
    
        $this->assertDatabaseMissing('replies', [
            'body' => 'My Reply',
            'ticket_id' => $ticket->id,
            'owner_id' => auth()->id()
        ]);
    }
    
    /** @test **/
    public function by_making_a_new_reply_from_admin_the_owner_of_the_reply_will_get_a_notification()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
    
        $this->assertCount(0, $user->unreadNotifications);
        
        $ticket = factory(Ticket::class)->create(['owner_id' => $user->id]);
        factory(Reply::class)->create(['owner_id' => auth()->id(), 'ticket_id' => $ticket->id]);

        $this->assertCount(1, $user->fresh()->unreadNotifications);
    }
    
    /** @test **/
    public function a_user_can_delete_his_replies()
    {
       $this->withoutExceptionHandling();
       $reply = factory(Reply::class)->create([
           'body' => 'A test reply',
           'owner_id' => auth()->id()
       ]);
       
       $this->delete(route('replies.destroy', [app()->getLocale(), $reply->id]));
       
       $this->assertDatabaseMissing('replies', [
           'body' => 'A test reply',
           'owner_id' => auth()->id()
       ]);
    }
}
