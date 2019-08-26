<?php

namespace App\Models\Invoicer;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
	use Sortable;

	protected $table = 'invoicer__clients';

	protected $fillable = [
		'company_name',
		'contact_name',
		'address',
		'city',
		'state',
		'zip',
		'telephone',
		'cell',
		'fax',
		'email',
		'website'
	];

	public $sortable = [
		'id',
		'company_name',
		'contact_name',
		'address',
		'city',
		'state',
		'zip',
		'telephone',
		'cell',
		'fax',
		'email',
		'website'
	];

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
	// A client has many invoices
	public function invoices() {
		return $this->hasMany('App\Models\Invoicer\Invoice')->orderBy('id','desc');
	}
	
	public function user() { 
		return $this->belongsTo('App\Models\User');
	}
}
