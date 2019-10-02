<?php

namespace Tests\Feature;

use App\Setting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageSettingsTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function guests_cannot_update_settings()
    {
        factory(Setting::class)->create();
        
        $this->patch('/dashboard/settings', [])->assertRedirect('login');
    }
    
    /** @test * */
    public function admin_can_make_new_settings()
    {
        $this->withoutExceptionHandling();
        
        $this->makeAdmin();
        
        $settings = factory(Setting::class)->make();
        
        $this->post('/settings', $settings->toArray());
        
        $this->assertDatabaseHas(
            'settings', [
            'upload_articles_per_day' => $settings->upload_articles_per_day,
            'upload_words_per_day' => $settings->upload_words_per_day,
            'price_per_word' => $settings->price_per_word,
            'base_price_for_docs' => $settings->base_price_for_docs
        ]);
    }
    
    /** @test * */
    public function non_admin_user_cannot_create_a_settings()
    {
        $this->signIn();
        
        $setting = factory(Setting::class)->make();
        
        $this->post('/settings', $setting->toArray())
             ->assertStatus(403);
    }
    
    /** @test * */
    public function admin_user_can_change_settings()
    {
        $this->makeAdmin();
        
        factory(Setting::class)->create();
        
        $settings = [
            'upload_articles_per_day' => 4,
            'upload_words_per_day' => 20000,
            'price_per_word' => 40,
            'base_price_for_docs' => 50000
        ];
        
        $this->patch('/settings/1', $settings);
        
        $this->assertDatabaseHas('settings', $settings);
    }
    
    /** @test * */
    public function non_admin_users_can_not_change_settings()
    {
        $this->signIn();
        
        factory(Setting::class)->create();
        
        $settings = [
            'upload_articles_per_day' => 4,
            'upload_words_per_day' => 20000,
            'price_per_word' => 40,
            'base_price_for_docs' => 50000
        ];
        
        $this->patch('/settings/1', $settings)->assertStatus(403);
    }
    
    /** @test * */
    public function update_settings_requires_a_valid_article_count()
    {
        $setting = factory(Setting::class)->create();
        
        $user = $this->makeAdmin();
        
        $settings = [
            'upload_articles_per_day' => null,
            'upload_words_per_day' => 20000
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('upload_articles_per_day');
        
        $settings = [
            'upload_articles_per_day' => 'hello',
            'upload_words_per_day' => 20000
        ];
        
        $this->patch('settings/1', $settings)
             ->assertSessionHasErrors('upload_articles_per_day');
    }
    
    /** @test * */
    public function update_settings_requires_a_valid_word_count()
    {
        factory(Setting::class)->create();
        
        $this->makeAdmin();
        
        $settings = [
            'upload_articles_per_day' => 4,
            'upload_words_per_day' => null
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('upload_words_per_day');
        
        $settings = [
            'upload_articles_per_day' => 4,
            'upload_words_per_day' => 'hello'
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('upload_words_per_day');
    }
    
    /** @test * */
    public function update_settings_requires_a_valid_price_per_words()
    {
        factory(Setting::class)->create();
        
        $this->makeAdmin();
        
        $settings = [
            'price_per_word' => null
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('price_per_word');
        
        $settings = [
            'price_per_word' => 'hello'
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('price_per_word');
    }
    
    /** @test * */
    public function update_settings_requires_a_valid_base_price()
    {
        factory(Setting::class)->create();
        
        $this->makeAdmin();
        
        $settings = [
            'base_price_for_docs' => null
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('base_price_for_docs');
        
        $settings = [
            'base_price_for_docs' => 'hello'
        ];
        
        $this->patch('/settings/1', $settings)
             ->assertSessionHasErrors('base_price_for_docs');
    }
}
