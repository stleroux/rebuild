<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsMaterialProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects-material_project', function(Blueprint $table)
		{
			$table->foreign('project_id', 'projects-material_project')->references('id')->on('projects-projects')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects-material_project', function(Blueprint $table)
		{
			$table->dropForeign('projects-material_project_ibfk_1');
		});
	}

}
