<?php

namespace Database\Seeders;

use App\Role;
use App\User;
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
        $adminRole = Role::factory()->create([
            'name' => 'super-admin',
            'label' => 'Super Admin',
        ]);

        $supportRole = Role::factory()->create([
            'name' => 'support',
            'label' => 'Support',
        ]);

        $adminUser = User::factory()->create([
            'name' => 'لامعه هاشمی',
            'email' => 'admin@redpencilit.com',
            'phone' => '0912345566',
            'password' => bcrypt('london123london'),
            'confirmed' => true
        ]);

        $supportUser = User::factory()->create([
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
