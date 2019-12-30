<?php

namespace App\Models\Invoicer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Collective\Html\Eloquent\FormAccessible;

class InvoiceItem extends Model
{
	use Sortable;
   use FormAccessible;

	protected $table = 'invoicer__invoice_items';
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

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
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


//////////////////////////////////////////////////////////////////////////////////////
// ACCESSORS
//////////////////////////////////////////////////////////////////////////////////////
   public function getCreatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }

   public function getUpdatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }

   public function formWorkDateAttribute($date)
   {
      // return Carbon::parse($date)->format('Y-m-d');
      return Carbon::parse($date)->format(setting('dateFormat'));
      // return $date->format(setting('dateFormat'));
   }

   public function getWorkDateAttribute($date)
   {
      // dd($date);
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }


}
