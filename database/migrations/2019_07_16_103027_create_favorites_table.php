<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavoritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorites', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index();
			$table->string('favoriteable_type');
			$table->bigInteger('favoriteable_id')->unsigned();
			$table->timestamps();
			$table->primary(['user_id','favoriteable_id','favoriteable_type']);
			$table->index(['favoriteable_type','favoriteable_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favorites');
	}

}
