<?php

namespace App\Modules\Invoicer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Invoicer\Models\Invoice;
use Config;
use DB;

class LedgerController extends Controller
{
	public function __construct()
   {
      $this->middleware('auth');
   }


	public function index()
	{
		$invoices = Invoice::sortable()
			->orderBy('id','desc')
			->paginate(Config::get('settings.rowsPerPage'))
			;
		$totalAmountCharged = DB::table('invoicer_invoices')->sum('amount_charged');
		$totalHST = DB::table('invoicer_invoices')->sum('hst');
		$totalSubTotal = DB::table('invoicer_invoices')->sum('sub_total');
		$totalWSIB = DB::table('invoicer_invoices')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer_invoices')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer_invoices')->sum('total_deductions');
		$totalTotal = DB::table('invoicer_invoices')->sum('total');
		// dd($invoices);
		return view('Invoicer::ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}

	public function paid()
	{
		$invoices = Invoice::sortable()->where('status','=','paid')
			->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer_invoices')->where('status','=','paid')->sum('amount_charged');
		$totalHST = DB::table('invoicer_invoices')->where('status','=','paid')->sum('hst');
		$totalSubTotal = DB::table('invoicer_invoices')->where('status','=','paid')->sum('sub_total');
		$totalWSIB = DB::table('invoicer_invoices')->where('status','=','paid')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer_invoices')->where('status','=','paid')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer_invoices')->where('status','=','paid')->sum('total_deductions');
		$totalTotal = DB::table('invoicer_invoices')->where('status','=','paid')->sum('total');

		return view('Invoicer::ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}

	public function invoiced()
	{
		$invoices = Invoice::sortable()->where('status','=','invoiced')
			->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('amount_charged');
		$totalHST = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('hst');
		$totalSubTotal = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('sub_total');
		$totalWSIB = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('total_deductions');
		$totalTotal = DB::table('invoicer_invoices')->where('status','=','invoiced')->sum('total');

		return view('Invoicer::ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}

	public function logged()
	{
		$invoices = Invoice::sortable()->where('status','=','logged')
			->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer_invoices')->where('status','=','logged')->sum('amount_charged');
		$totalHST = DB::table('invoicer_invoices')->where('status','=','logged')->sum('hst');
		$totalSubTotal = DB::table('invoicer_invoices')->where('status','=','logged')->sum('sub_total');
		$totalWSIB = DB::table('invoicer_invoices')->where('status','=','logged')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer_invoices')->where('status','=','logged')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer_invoices')->where('status','=','logged')->sum('total_deductions');
		$totalTotal = DB::table('invoicer_invoices')->where('status','=','logged')->sum('total');

		return view('Invoicer::ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}

}
