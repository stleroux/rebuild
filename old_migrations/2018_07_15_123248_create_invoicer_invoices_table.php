<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicerInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoicer_invoices', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->text('notes')->nullable();
			$table->string('status');
			$table->decimal('amount_charged')->unsigned()->nullable();
			$table->decimal('hst')->unsigned()->nullable();
			$table->decimal('sub_total')->unsigned()->nullable();
			$table->decimal('wsib')->unsigned()->nullable();
			$table->decimal('income_taxes')->unsigned()->nullable();
			$table->decimal('total_deductions')->unsigned()->nullable();
			$table->decimal('total')->unsigned()->nullable();
			$table->timestamp('invoiced_at')->nullable();
			$table->timestamp('paid_at')->nullable();
			$table->timestamps();

			// Add foreign key in the database manually
			$table->foreign('client_id')->references('id')->on('invoicer_clients')->onDelete('cascade');
		});

		// Schema::table('invoicer_invoices', function (Blueprint $table) {});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::disableForeignKeyConstraints();
		Schema::dropIfExists('invoicer_invoices');
	}
}
