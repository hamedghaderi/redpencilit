<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('body');
            $table->unsignedInteger('owner_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
