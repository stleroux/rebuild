<?php

namespace Modules\Invoicer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Invoicer\Entities\Client;
use Modules\Invoicer\Entities\Invoice;
use Modules\Invoicer\Entities\InvoiceItem;
use Modules\Invoicer\Entities\Product;
//use Auth;
//use Charts;

class DashboardController extends Controller
{

##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################
	public function __construct() {
		$this->middleware('auth');
		//Log::useFiles(storage_path().'/logs/articles.log');
		//Log::useFiles(storage_path().'/logs/audits.log');
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
	  if(!checkPerm('invoicer_dashboard')) { abort(401, 'Unauthorized Access'); }

	  $clients = Client::orderBy('company_name','asc')->get();
	  $invoicesTotal = Invoice::all();
	  $invoicesLogged = Invoice::where('status','logged')->get();
	  $invoicesInvoiced = Invoice::where('status','invoiced')->get();
	  $invoicesPaid = Invoice::where('status','paid')->get();
	  $invoiceItems = InvoiceItem::all();
	  $products = Product::all();
	  
		return view('invoicer::dashboard.index', compact('clients', 'invoicesTotal', 'invoicesLogged', 'invoicesInvoiced', 'invoicesPaid', 'invoiceItems', 'products'));
	}

}
