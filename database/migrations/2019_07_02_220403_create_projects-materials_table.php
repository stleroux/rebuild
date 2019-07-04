<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsMaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects-materials', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 250);
			$table->string('type', 250);
			$table->text('notes', 65535);
			$table->string('manufacturer', 250);
			$table->string('UPC', 50);
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
		Schema::drop('projects-materials');
	}

}
