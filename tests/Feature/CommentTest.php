<?php

namespace Tests\Feature;

use App\Comment;
use App\Mail\CommentMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_send_email_and_his_comment_about_the_website()
    {
        Mail::fake();

        $this->withoutExceptionHandling();

        $this->makeAdmin();

        $this->postJson(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => 'My Message',
            'rate' => 3
        ]);

        $this->assertDatabaseHas('comments', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => 'My Message',
            'rate' => 3
        ]);
    }

    /** @test **/
    public function a_contact_comment_also_sent_to_the_super_admin_as_an_email()
    {
        $this->withoutExceptionHandling();

        $john = $this->makeAdmin();

        Mail::fake();

        $this->postJson(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => 'My Message'
        ]);

        Mail::assertSent(CommentMessage::class, 1);
    }

    /** @test **/
    public function a_contact_message_requires_a_name()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => null,
            'email' => 'john@doe.com',
            'message' => 'My Message'
        ])->assertSessionHasErrors('name');
    }

    /** @test **/
    public function a_contact_message_name_should_be_at_least_3_chars()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => 'll',
            'email' => 'john@doe.com',
            'message' => 'My Message'
        ])->assertSessionHasErrors('name');
    }

    /** @test **/
    public function a_contact_requires_an_email()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => null,
            'message' => 'My Message'
        ])->assertSessionHasErrors('email');
    }

    /** @test **/
    public function a_contact_email_should_be_a_valid_email()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => 'kjasdlfjasdkf',
            'message' => 'My Message'
        ])->assertSessionHasErrors('email');
    }

    /** @test **/
    public function a_contact_requires_a_message()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => null
        ])->assertSessionHasErrors('message');
    }

    /** @test **/
    public function a_contact_message_should_be_at_least_5_characters()
    {
        $this->post(route('comments.store', app()->getLocale()),  [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => 'kjkj'
        ])->assertSessionHasErrors('message');
    }

    /** @test **/
    public function super_admin_can_see_all_comments()
    {
        $this->withoutExceptionHandling();

        $this->makeAdmin();

        $comment = create(Comment::class);

        $this->get(route('admin.users.comments', app()->getLocale()))
             ->assertSee($comment->name);
    }

    /** @test **/
    public function super_admin_can_delete_a_comment()
    {
       $this->withoutExceptionHandling();

       $user = $this->makeAdmin();

       $comment = create(Comment::class);

       $this->deleteJson(route('comment.destroy', [app()->getLocale(), $comment]));

       $this->assertDatabaseMissing('comments', [
           'name' => $comment->name,
       ]);
    }
}
