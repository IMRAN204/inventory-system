<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('customer_name');
            $table->string('address');
            $table->integer('phone');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->integer('discount')->nullable();
            $table->float('weight',9,2)->nullable();
            $table->string('area');
            $table->unsignedBigInteger('delivery_media_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            //$table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('delivery_media_id')->references('id')->on('delivery_media');
            $table->timestamps();
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
};
