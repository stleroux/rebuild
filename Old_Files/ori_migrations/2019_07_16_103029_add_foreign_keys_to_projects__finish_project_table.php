<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsFinishProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects__finish_project', function(Blueprint $table)
		{
			$table->foreign('project_id', 'projects__finish_project')->references('id')->on('projects__projects')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects__finish_project', function(Blueprint $table)
		{
			$table->dropForeign('projects__finish_project');
		});
	}

}
