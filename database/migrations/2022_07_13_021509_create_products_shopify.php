<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsShopify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_shopify', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body_html');
            $table->string('status');
            $table->string('vendor');
            $table->string('product_type');
            $table->string('image')->nullable();
            $table->integer('compare_at_price')->nullable();
            $table->integer('inventory_quantity')->nullable();
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
        Schema::dropIfExists('products_shopify');
    }
}
