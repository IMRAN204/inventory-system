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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->string('supplier')->nullable();
            $table->unsignedBigInteger('purchase_type_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('purchase_type_id')->references('id')->on('purchase_types');
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
        Schema::dropIfExists('products');
    }
};
