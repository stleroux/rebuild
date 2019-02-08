<?php

namespace Modules\Invoicer\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
	use Sortable;

	protected $table = 'invoicer_clients';

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
	
	// A client has many invoices
	public function invoices() {
		return $this->hasMany('Modules\Invoicer\Entities\Invoice')->orderBy('id','desc');
	}
	
	public function user() { 
		return $this->belongsTo('App\User');
	}
}
