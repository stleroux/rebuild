<?php

namespace App\Modules\Invoicer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Auth;
//use Charts;
use App\Modules\Invoicer\Models\Client;
use App\Modules\Invoicer\Models\Invoice;
use App\Modules\Invoicer\Models\InvoiceItem;
use App\Modules\Invoicer\Models\Product;

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
      $clients = Client::orderBy('company_name','asc')->get();
      $invoicesTotal = Invoice::all();
      $invoicesLogged = Invoice::where('status','logged')->get();
      $invoicesInvoiced = Invoice::where('status','invoiced')->get();
      $invoicesPaid = Invoice::where('status','paid')->get();
      $invoiceItems = InvoiceItem::all();
      $products = Product::all();
      
		return view('Invoicer::dashboard.index', compact('clients', 'invoicesTotal', 'invoicesLogged', 'invoicesInvoiced', 'invoicesPaid', 'invoiceItems', 'products'));
	}

}
