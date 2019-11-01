<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('articles_user_id_foreign');
			$table->integer('category_id')->unsigned()->index('articles_category_id_foreign');
			$table->string('title');
			$table->text('description_eng', 65535);
			$table->text('description_fre', 65535)->nullable();
			$table->integer('views')->unsigned()->default(0);
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
		Schema::drop('articles');
	}

}
