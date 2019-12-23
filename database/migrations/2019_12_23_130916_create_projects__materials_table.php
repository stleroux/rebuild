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
		Schema::create('projects__materials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->string('type', 250)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->string('manufacturer', 250)->nullable();
			$table->string('UPC', 50)->nullable();
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
		Schema::drop('projects__materials');
	}

}
