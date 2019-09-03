<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('email')->unique();
			$table->integer('public_email')->unsigned()->default(0);
			$table->string('password');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('telephone')->nullable();
			$table->string('cell')->nullable();
			$table->string('fax')->nullable();
			$table->string('website')->nullable();
			$table->string('image')->nullable();
			$table->string('civic_number', 10)->nullable();
			$table->string('address_1', 150)->nullable();
			$table->string('address_2', 150)->nullable();
			$table->string('city', 60)->nullable();
			$table->string('province', 60)->nullable();
			$table->string('postal_code', 20)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->boolean('invoicer_client')->default(0);
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
			$table->string('remember_token', 100)->nullable();
			$table->dateTime('previous_login_date')->nullable();
			$table->dateTime('last_login_date')->nullable();
			$table->integer('login_count')->unsigned()->default(0);
			$table->dateTime('email_verified_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
