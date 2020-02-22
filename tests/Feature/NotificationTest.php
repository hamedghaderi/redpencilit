<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->signIn();
    }
    
    /** @test * */
    public function a_user_can_fetch_their_unread_notifications()
    {
        $this->withoutExceptionHandling();
        
        create(DatabaseNotification::class);
        
        $this->assertCount(
            1,
            $this->getJson(
                route(
                    'notifications.index',
                    [app()->getLocale(), auth()->user()->id])
            )->json()
        );
    }
    
    /** @test **/
    public function a_user_can_read_a_notification()
    {
       $this->withoutExceptionHandling();
       
       $notification = create(DatabaseNotification::class);
       
       $this->assertCount(1, auth()->user()->unreadNotifications);
       
       $this->deleteJson(route('notifications.destroy', [app()->getLocale(), auth()->user(), $notification->id]));
       
       $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
    }
    
    /** @test **/
    public function a_user_can_mark_all_notifications_as_read()
    {
       $this->withoutExceptionHandling();
       
       $notifications = create(DatabaseNotification::class, ['notifiable_id' => auth()->id()], 2);
       
       $this->assertCount(2, auth()->user()->unreadNotifications);
       
       $this->deleteJson(route('notifications.destroy.all', [app()->getLocale(), auth()->id()]));
       
       $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
    }
}
