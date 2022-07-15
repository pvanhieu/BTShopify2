<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbshop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbshop', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('dbshop');
    }
}
