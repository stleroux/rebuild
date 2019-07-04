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
			$table->integer('id', true);
			$table->string('name', 250);
			$table->string('type', 250);
			$table->string('color_name', 250);
			$table->string('color_code', 250);
			$table->string('sheen', 50);
			$table->string('manufacturer', 250);
			$table->string('upc', 250);
			$table->text('notes', 65535);
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
