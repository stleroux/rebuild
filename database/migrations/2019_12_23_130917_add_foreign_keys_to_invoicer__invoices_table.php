<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInvoicerInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoicer__invoices', function(Blueprint $table)
		{
			$table->foreign('user_id', 'invoicer__invoices_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoicer__invoices', function(Blueprint $table)
		{
			$table->dropForeign('invoicer__invoices_ibfk_2');
		});
	}

}
