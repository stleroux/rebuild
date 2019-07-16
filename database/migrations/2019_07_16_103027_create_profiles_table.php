<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('profiles_user_id_foreign');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('telephone')->nullable();
			$table->string('image')->nullable();
			$table->string('civic_number', 10)->nullable();
			$table->string('address1', 150)->nullable();
			$table->string('address2', 150)->nullable();
			$table->string('city', 60)->nullable();
			$table->string('province', 60)->nullable();
			$table->string('postal_code', 20)->nullable();
			$table->string('frontendStyle')->default('slate');
			$table->string('backendStyle')->default('bootstrap');
			$table->integer('date_format')->default(1);
			$table->string('landing_page_id')->default('41');
			$table->integer('rows_per_page')->unsigned()->default(15);
			$table->string('display_size')->default('normal');
			$table->string('action_buttons')->default('1');
			$table->string('author_format')->default('1');
			$table->integer('alert_fade_time')->unsigned()->default(5000);
			$table->integer('layout')->unsigned()->default(1);
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
		Schema::drop('profiles');
	}

}
