<?php

namespace App\Http\Controllers\Invoicer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Invoicer\Client;
use App\Models\Invoicer\Invoice;
use App\Models\Invoicer\InvoiceItem;
use App\Models\Invoicer\Product;
use App\models\User;
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
      $this->enablePermissions = false;
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

	  // $clients = Client::orderBy('company_name','asc')->get();
	  $clients = User::where('invoicer_client', 1)->orderBy('company_name','asc')->get();
	  $invoicesTotal = Invoice::all();
	  $invoicesLogged = Invoice::where('status','logged')->get();
	  $invoicesInvoiced = Invoice::where('status','invoiced')->get();
	  $invoicesPaid = Invoice::where('status','paid')->get();
	  $invoiceItems = InvoiceItem::all();
	  $products = Product::all();
	  
		return view('invoicer.dashboard.index', compact('clients', 'invoicesTotal', 'invoicesLogged', 'invoicesInvoiced', 'invoicesPaid', 'invoiceItems', 'products'));
	}

}
