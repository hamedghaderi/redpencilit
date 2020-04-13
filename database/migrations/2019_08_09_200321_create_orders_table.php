<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id');
            $table->unsignedBigInteger('total_words');
            $table->decimal('price', 20, 0);
            $table->smallInteger('status')->default(1)->index();
            $table->timestamp('delivery_date');
            $table->smallInteger('orders_count')->index();
            $table->unsignedInteger('service_id')->nullable();
            $table->string('token')->index()->nullable();
            $table->boolean('payed')->default(false);
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->string('card_number')->nullable();
            $table->string('trace_number')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
