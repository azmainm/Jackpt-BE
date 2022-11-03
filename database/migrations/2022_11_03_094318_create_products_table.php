<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title')->nullable();
            $table->integer('user_id');
            $table->integer('price');
            $table->string('slug')->unique();
            $table->integer('discounted_price')->nullable();
            $table->string('description')->nullable();
            $table->json('variant')->nullable();
            $table->json('color')->nullable();
            $table->string('product_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('short_image')->nullable();
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
}
