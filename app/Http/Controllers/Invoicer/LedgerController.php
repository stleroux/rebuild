<?php

namespace App\Http\Controllers\Invoicer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Invoicer\Invoice;
use Config;
use DB;

class LedgerController extends Controller
{
##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################
	public function __construct()
   {
	  $this->middleware('auth');
     $this->enablePermissions = false;
   }


##################################################################################################################
# ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
# ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
# ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
# ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
# ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
# ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
// Display a list of resources
##################################################################################################################
	public function index()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_ledger')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer__invoices')->sum('amount_charged');
		$totalHST = DB::table('invoicer__invoices')->sum('hst');
		$totalSubTotal = DB::table('invoicer__invoices')->sum('sub_total');
		$totalWSIB = DB::table('invoicer__invoices')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer__invoices')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer__invoices')->sum('total_deductions');
		$totalTotal = DB::table('invoicer__invoices')->sum('total');

		return view('invoicer.ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}


##################################################################################################################
# ██╗███╗   ██╗██╗   ██╗ ██████╗ ██╗ ██████╗███████╗██████╗ 
# ██║████╗  ██║██║   ██║██╔═══██╗██║██╔════╝██╔════╝██╔══██╗
# ██║██╔██╗ ██║██║   ██║██║   ██║██║██║     █████╗  ██║  ██║
# ██║██║╚██╗██║╚██╗ ██╔╝██║   ██║██║██║     ██╔══╝  ██║  ██║
# ██║██║ ╚████║ ╚████╔╝ ╚██████╔╝██║╚██████╗███████╗██████╔╝
# ╚═╝╚═╝  ╚═══╝  ╚═══╝   ╚═════╝ ╚═╝ ╚═════╝╚══════╝╚═════╝ 
##################################################################################################################
	public function invoiced()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_ledger')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()->where('status','=','invoiced')->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('amount_charged');
		$totalHST = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('hst');
		$totalSubTotal = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('sub_total');
		$totalWSIB = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('total_deductions');
		$totalTotal = DB::table('invoicer__invoices')->where('status','=','invoiced')->sum('total');

		return view('invoicer.ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}


##################################################################################################################
# ██╗      ██████╗  ██████╗  ██████╗ ███████╗██████╗ 
# ██║     ██╔═══██╗██╔════╝ ██╔════╝ ██╔════╝██╔══██╗
# ██║     ██║   ██║██║  ███╗██║  ███╗█████╗  ██║  ██║
# ██║     ██║   ██║██║   ██║██║   ██║██╔══╝  ██║  ██║
# ███████╗╚██████╔╝╚██████╔╝╚██████╔╝███████╗██████╔╝
# ╚══════╝ ╚═════╝  ╚═════╝  ╚═════╝ ╚══════╝╚═════╝
##################################################################################################################
	public function logged()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_ledger')) { abort(401, 'Unauthorized Access'); }
	  
		$invoices = Invoice::sortable()->where('status','=','logged')->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer__invoices')->where('status','=','logged')->sum('amount_charged');
		$totalHST = DB::table('invoicer__invoices')->where('status','=','logged')->sum('hst');
		$totalSubTotal = DB::table('invoicer__invoices')->where('status','=','logged')->sum('sub_total');
		$totalWSIB = DB::table('invoicer__invoices')->where('status','=','logged')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer__invoices')->where('status','=','logged')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer__invoices')->where('status','=','logged')->sum('total_deductions');
		$totalTotal = DB::table('invoicer__invoices')->where('status','=','logged')->sum('total');

		return view('invoicer.ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}


##################################################################################################################
# ██████╗  █████╗ ██╗██████╗ 
# ██╔══██╗██╔══██╗██║██╔══██╗
# ██████╔╝███████║██║██║  ██║
# ██╔═══╝ ██╔══██║██║██║  ██║
# ██║     ██║  ██║██║██████╔╝
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═════╝ 
##################################################################################################################
	public function paid()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_ledger')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()->where('status','=','paid')->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));
		$totalAmountCharged = DB::table('invoicer__invoices')->where('status','=','paid')->sum('amount_charged');
		$totalHST = DB::table('invoicer__invoices')->where('status','=','paid')->sum('hst');
		$totalSubTotal = DB::table('invoicer__invoices')->where('status','=','paid')->sum('sub_total');
		$totalWSIB = DB::table('invoicer__invoices')->where('status','=','paid')->sum('wsib');
		$totalIncomeTaxes = DB::table('invoicer__invoices')->where('status','=','paid')->sum('income_taxes');
		$totalTotalDeductions = DB::table('invoicer__invoices')->where('status','=','paid')->sum('total_deductions');
		$totalTotal = DB::table('invoicer__invoices')->where('status','=','paid')->sum('total');

		return view('invoicer.ledger.index', compact('invoices','totalHST','totalAmountCharged','totalSubTotal', 'totalWSIB', 'totalIncomeTaxes','totalTotalDeductions', 'totalTotal'));
	}


}
