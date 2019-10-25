<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeDegreesTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'college_degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->json('name');
            $table->timestamps();
        });
        
        $this->fillTable();
    }
    
    protected function fillTable()
    {
        $path = resource_path().'/data/degrees.json';
        $data = json_decode(file_get_contents($path), true);
        
        foreach ($data as $item) {
            \Illuminate\Support\Facades\DB::table('college_degrees')->insert(
                [
                    'name' => json_encode($item),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('college_degrees');
    }
}
