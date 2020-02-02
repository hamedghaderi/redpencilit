<?php

namespace Tests\Feature;

use App\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDetailsTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function a_user_can_have_other_details()
    {
        $this->withoutExceptionHandling();
        
        $user = $this->signIn();
        
        $userDetails = make(UserDetail::class);
        
        $this->post(route('details.store', app()->getLocale()), $userDetails->toArray());
        
        $this->assertDatabaseHas('user_details', [
            'user_id' => $user->id,
            'address' => $userDetails->address,
            'degree_id' => $userDetails->degree_id,
            'country_id' => $userDetails->country_id,
            'field' => $userDetails->field,
            'college' => $userDetails->college,
            'gender' => $userDetails->gender
        ]);
    }
    
    /** @test **/
    public function a_user_can_update_his_details()
    {
       $this->withoutExceptionHandling();
       
       $user = $this->signIn();
       
       $userDetails = create(UserDetail::class, ['user_id' => $user->id]);
       
       $this->patch(route('details.update', [app()->getLocale(), $user]) , [
           'country_id' => 3,
           'address' => 'Baharan',
           'field' => 'Computer',
           'college' => 'Azad',
           'degree_id' => 3,
           'gender' => false,
       ]);
       
       $this->assertDatabaseHas('user_details', [
           'country_id' => 3,
           'address' => 'Baharan',
           'field' => 'Computer',
           'college' => 'Azad',
           'degree_id' => 3,
           'gender' => false
       ]);
    }
}
