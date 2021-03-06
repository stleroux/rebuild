<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoviesTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('movies', function(Blueprint $table)
      {
         $table->increments('id');
         $table->integer('user_id');
         $table->string('title');
         $table->string('email');
         $table->integer('category');
         $table->integer('views')->default(0);
         $table->dateTime('published_at')->nullable();
         $table->softDeletes();
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
      Schema::drop('movies');
   }

}