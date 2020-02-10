<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = factory(\App\Role::class)->create([
            'name' => 'super-admin',
            'label' => 'Super Admin',
        ]);
        
        $supportRole = factory(\App\Role::class)->create([
            'name' => 'support',
            'label' => 'Support',
        ]);
        
        $adminUser = factory(\App\User::class)->create([
            'name' => 'لامعه هاشمی',
            'email' => 'admin@redpencilit.com',
            'phone' => '0912345566',
            'password' => bcrypt('london123london'),
            'confirmed' => true
        ]);
        
        $supportUser = factory(\App\User::class)->create([
            'name' => 'حامد قادری',
            'email' => 'hamedghaderii@gmail.com',
            'phone' => '09369396387',
            'confirmed' => true,
            'password' => bcrypt('40Minutes!!!!!!')
        ]);
        
        $adminUser->addRole($adminRole);
        $supportUser->addRole($supportRole);
    }
}
