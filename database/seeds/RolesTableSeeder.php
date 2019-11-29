<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
        Role::create([
            'name' => 'super-admin',
            'label' => 'Super Admin'
        ]);
        
        Role::create([
            'name' => 'author',
            'label' => 'Author'
        ]);
    }
}
