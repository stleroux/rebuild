<?php

namespace Modules\Invoicer\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
	use Sortable;

	protected $table = 'invoicer_products';

	protected $fillable = [
		'code',
		'details'
	];

	public $sortable = [
		'code',
		'details'
	];

}
