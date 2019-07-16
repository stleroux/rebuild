<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInvoicerInvoiceItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoicer__invoice_items', function(Blueprint $table)
		{
			$table->foreign('invoice_id')->references('id')->on('invoicer__invoices')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('invoicer__products')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoicer__invoice_items', function(Blueprint $table)
		{
			$table->dropForeign('invoicer__invoice_items_invoice_id_foreign');
			$table->dropForeign('invoicer__invoice_items_product_id_foreign');
		});
	}

}
