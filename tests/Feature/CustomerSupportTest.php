<?php

namespace Tests\Feature;

use App\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerSupportTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function a_customer_can_make_a_new_ticket()
    {
        $this->withoutExceptionHandling();
        
        $user = $this->signIn();
        $admin = $this->makeAdmin();
        
        $storage = Storage::fake('ticket');
        
        $this->post(route('tickets.store', app()->getLocale()), [
            'title' => 'My Title',
            'body' => 'My Body',
            'attachment' => $file = UploadedFile::fake()->image('ticket.png'),
        ]);
        
        $this->get(route('tickets.create', app()->getLocale()))
             ->assertSee('My Title')
             ->assertSee('My Body');
        
        $this->assertDatabaseHas('tickets', [
            'title' => 'My Title',
            'body' => 'My Body',
        ]);
    }
    
    /** @test * */
    public function when_a_user_create_a_new_ticket_a_notification_will_sent_to_admin()
    {
        $this->withoutExceptionHandling();
        
        $admin = $this->makeAdmin();
        $this->assertEquals(0, $admin->unreadNotifications()->count());
        
        $ticket = factory(Ticket::class)->create();
        $this->assertEquals(1, $admin->fresh()->unreadNotifications()->count());
    }
    
    /** @test * */
    public function an_admin_can_see_all_tickets()
    {
        $this->withoutExceptionHandling();
        
        $admin = $this->makeAdmin();
        $ticket = create(Ticket::class, ['title' => 'Hello There']);
        
        $this->get(route('admin.tickets.show', [app()->getLocale(), $ticket->id]))
            ->assertSee('Hello There');
    }
}
