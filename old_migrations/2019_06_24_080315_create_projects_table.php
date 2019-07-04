<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('projects', function(Blueprint $table)
      {
         $table->increments('id');
         $table->integer('category')->unsigned();
         $table->string('name');
         $table->text('description');
         $table->integer('views')->unsigned()->default(0);
         $table->integer('time_invested')->unsigned()->nullable();;
         $table->integer('price')->unsigned()->nullable();
         $table->integer('width')->unsigned()->nullable();
         $table->integer('depth')->unsigned()->nullable();
         $table->integer('height')->unsigned()->nullable();
         $table->integer('weight')->unsigned()->nullable();
         $table->timestamp('completed_at')->nullable();
         $table->timestamps();            

         // Add foreign key in the database manually
         // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      });
   }


   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::drop('projects');
   }

}