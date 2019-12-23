<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicerInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoicer__invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('invoicer_invoices_client_id_foreign');
			$table->text('notes', 65535)->nullable();
			$table->string('status');
			$table->decimal('amount_charged')->unsigned()->nullable();
			$table->decimal('hst')->unsigned()->nullable();
			$table->decimal('sub_total')->unsigned()->nullable();
			$table->decimal('wsib')->unsigned()->nullable();
			$table->decimal('income_taxes')->unsigned()->nullable();
			$table->decimal('total_deductions')->unsigned()->nullable();
			$table->decimal('total')->unsigned()->nullable();
			$table->dateTime('invoiced_at')->nullable();
			$table->dateTime('paid_at')->nullable();
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
		Schema::drop('invoicer__invoices');
	}

}
