<?php

namespace App\Models\Invoicer;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class InvoiceItem extends Model
{
	use Sortable;

	protected $table = 'invoicer_invoiceItems';
	protected $dates = ['work_date'];

	protected $fillable = [
		'invoice_id',
		'product_id',
		'notes',
		'work_date',
		'quantity',
		'price',
		'total'
	];

	public $sortable = [
		'id',
		'created_at'
	];


	// public function getTotal() {
	// 	return $this->price * $this->quantity;
	// }

	// An item belongs to an invoice
	public function invoice()
	{
		return $this->belongsTo('App\Models\Invoicer\Invoice');
	}

	// A product belongs to an invoice
	public function product()
	{
		return $this->belongsTo('App\Models\Invoicer\Product');
	}


}
