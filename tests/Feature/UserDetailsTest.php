<?php

namespace Tests\Feature;

use App\CollegeDegree;
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
        
        $this->post('/details', $userDetails->toArray());
        
        $this->assertDatabaseHas('user_details', [
            'user_id' => $user->id,
            'address' => $userDetails->address,
            'degree_id' => $userDetails->degree_id,
            'country_id' => $userDetails->country_id,
            'field' => $userDetails->field,
            'college' => $userDetails->college
        ]);
    }
    
    /** @test **/
    public function a_user_can_update_his_details()
    {
       $this->withoutExceptionHandling();
       
       $user = $this->signIn();
       
       $userDetails = create(UserDetail::class, ['user_id' => $user->id]);
       
       $this->patch('/users/' . auth()->id() . '/details' , [
           'country_id' => 3,
           'address' => 'Baharan',
           'field' => 'Computer',
           'college' => 'Azad',
           'degree_id' => 3
       ]);
       
       $this->assertDatabaseHas('user_details', [
           'country_id' => 3,
           'address' => 'Baharan',
           'field' => 'Computer',
           'college' => 'Azad',
           'degree_id' => 3
       ]);
    }
}
