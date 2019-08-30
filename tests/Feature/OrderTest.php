<?php

namespace Tests\Feature;

use App\Order;
use App\OrderDetail;
use App\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test **/
    public function a_user_can_visit_his_orders()
    {
        $user = $this->signIn();
        
        $user->confirmed = true;
        
        $order = create(Order::class, ['owner_id' => $user->id]) ;
        
        $this->get('/users/' . $user->username  . '/orders')->assertSee($order->total_words);
        
    }
    
    /** @test * */
    public function a_user_can_upload_a_single_document()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        
        $user->confirmed = true;
        
        $settings = create(
            Setting::class, [
            'price_per_word' => 50,
            'base_price_for_docs' => 50000,
            'upload_words_per_day' => 20000,
            'upload_articles_per_day' => 4
        ]);
        
        $response = $this->json(
            'post',
            '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $file = $this->makeTestFile('951')
            ]
        ])->assertJson(['status' => 200]);
        
        $this->assertDatabaseHas(
            'orders', [
            'total_words' => 1010,
            'orders_count' => 1,
        ]);
        
        $this->assertDatabaseHas(
            'order_details', [
            'path' => $user->username.'/'.$file->hashName()
        ]);
    }
    
    /** @test * */
    public function a_user_can_upload_an_array_of_documents()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        
        $user->confirmed = true;
        
        $settings = create(
            Setting::class, [
            'price_per_word' => 50,
            'base_price_for_docs' => 50000,
            'upload_words_per_day' => 20000,
            'upload_articles_per_day' => 4
        ]);
        
        $response = $this->json(
            'post',
            '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $files[0] = $this->makeTestFile('951'),
                1 => $file[1] = $this->makeTestFile('1')
            ]
        ])->assertJson(['status' => 200]);
        
        $this->assertDatabaseHas(
            'orders', [
            'orders_count' => 2,
            'total_words' => 6843,
        ]);
    }
    
    /** @test * */
    public function guests_can_not_upload_documents()
    {
        $this->json('post', '/users/hamed/order', [])
             ->assertStatus(404);
    }
    
    /** @test * */
    public function singed_in_users_can_not_upload_documents_until_verified()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        
        $settings = create(
            Setting::class, [
            'price_per_word' => 50,
            'base_price_for_docs' => 50000,
            'upload_words_per_day' => 20000,
            'upload_articles_per_day' => 4
        ]);
        
        $response = $this->json(
            'post', '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $files[0] = $this->makeTestFile('951'),
            ]
        ])->assertStatus(401);
    }
    
    /** @test * */
    public function a_user_can_not_upload_more_than_settings_file_upload()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $settings = create(
            Setting::class, [
            'price_per_word' => 50,
            'base_price_for_docs' => 50000,
            'upload_words_per_day' => 20000,
            'upload_articles_per_day' => 1
        ]);
        
        $this->json(
            'post', '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $files[0] = $this->makeTestFile('951'),
                1 => UploadedFile::fake()->create('2.docx'),
            ]
        ])->assertJson(['errors' => true]);
    }
    
    /** @test * */
    public function a_document_can_not_be_more_than_limited_words()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $settings = create(
            Setting::class, [
            'price_per_word' => 50,
            'base_price_for_docs' => 50000,
            'upload_words_per_day' => 100,
            'upload_articles_per_day' => 4
        ]);
        
        $this->json(
            'post', '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $files[0] = $this->makeTestFile('951'),
            ]
        ])->assertJson(['errors' => true]);
    }
    
    /** @test * */
    public function if_a_document_words_price_is_less_than_the_base_price_the_base_price_will_take_affect()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $setting = create(
            Setting::class, [
            'base_price_for_docs' => 50000,
            'price_per_word' => 10
        ]);
        
        $this->json(
            'post', '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $this->makeTestFile('951')
            ]
        ]);
        
        $this->assertDatabaseHas('orders', ['price' => 50000]);
    }
    
    /** @test * */
    public function if_a_document_words_price_is_higher_than_the_base_price_the_product_of_words_will_affect()
    {
        Storage::fake('documents');
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $setting = create(
            Setting::class, [
            'base_price_for_docs' => 50000,
            'price_per_word' => 500
        ]);
        
        $this->json(
            'post', '/users/'.$user->username.'/orders', [
            'documents' => [
                0 => $this->makeTestFile('951')
            ]
        ]);
        
        $this->assertDatabaseHas('orders', ['total_words' => 1010, 'price' => 505000]);
    }
    
    /** @test * */
    public function a_user_can_delete_his_orders()
    {
        $this->withoutExceptionHandling();
        
        Storage::fake('documents');
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $setting = create(Setting::class);
        
        $this->json('post', '/users/' . $user->username . '/orders/', [
            'documents' => [
                0 => $this->makeTestFile('951')
            ]
        ])->assertJson(['status' => 200]);
        
        $this->assertEquals(1, count(Storage::disk('documents')->allFiles()));
        
        $this->json('delete', "/users/{$user->username}/orders/1");
        
        $this->assertEquals(0, count(Storage::disk('documents')->allFiles()));
        $this->assertCount(0, Order::all());
        $this->assertCount(0, OrderDetail::all());
    }
}
