<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsFinishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects-finishes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->string('type', 250)->nullable();
			$table->string('color_name', 250)->nullable();
			$table->string('color_code', 250)->nullable();
			$table->string('sheen', 50)->nullable();
			$table->string('manufacturer', 250)->nullable();
			$table->string('upc', 250)->nullable();
			$table->text('notes', 65535)->nullable();
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
		Schema::drop('projects-finishes');
	}

}
