<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->json('name');
            $table->timestamps();
        });
        
        $this->fill();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countires');
    }
    
    protected function fill()
    {
        $path = resource_path() . '/data/countries.json';
        
        $data = json_decode(file_get_contents($path), true);
        
        
        foreach ($data as $item)  {
            \Illuminate\Support\Facades\DB::table('countries')->insert([
                'name' => json_encode($item),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
