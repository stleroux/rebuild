<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{

    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id');
            $table->integer('display_order')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('menus');
    }

}