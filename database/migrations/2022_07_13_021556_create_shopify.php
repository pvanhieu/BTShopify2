<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopify', function (Blueprint $table) {
            $table->id();
            $table-> string('name');
            $table-> string('domain');
            $table-> string('email');
            $table-> string('shopify_domain');
            $table-> string('plan_name');
            $table-> string('access_token');
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
        Schema::dropIfExists('shopify');
    }
}
