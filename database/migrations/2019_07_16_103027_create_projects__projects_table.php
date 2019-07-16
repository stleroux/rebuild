<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects__projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category')->unsigned();
			$table->string('name');
			$table->text('description', 65535);
			$table->integer('views')->unsigned()->default(0);
			$table->integer('time_invested')->unsigned()->nullable();
			$table->integer('price')->unsigned()->nullable();
			$table->integer('width')->unsigned()->nullable();
			$table->integer('depth')->unsigned()->nullable();
			$table->integer('height')->unsigned()->nullable();
			$table->integer('weight')->unsigned()->nullable();
			$table->dateTime('completed_at')->nullable();
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
		Schema::drop('projects__projects');
	}

}
