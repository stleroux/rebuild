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
			$table->foreign('client_id')->references('id')->on('invoicer__clients')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
			$table->dropForeign('invoicer__invoices_client_id_foreign');
		});
	}

}
