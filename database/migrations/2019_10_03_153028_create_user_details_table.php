<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('field', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('college', 255)->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references("id")->on('users')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('college_degrees')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
