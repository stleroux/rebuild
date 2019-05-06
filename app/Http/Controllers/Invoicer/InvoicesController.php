<?php

namespace App\Http\Controllers\Invoicer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Invoicer\Client;
use App\Models\Invoicer\Invoice;
use App\Models\Invoicer\InvoiceItem;
use App\Models\Invoicer\Product;
use App\Mail\Invoicer\InvoicedPDFMail;
use carbon\Carbon;
use Config;
use DB;
use PDF;
use Session;

class InvoicesController extends Controller
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
   }


##################################################################################################################
#  ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
# ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
# ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
# ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
#  ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// Show the form for creating a new resource
##################################################################################################################
	public function create($id = null)
	{
		// Check if user has required permission
		if(!checkPerm('invoicer_invoice_create')) { abort(401, 'Unauthorized Access'); }

		$products = Product::all();
		$clients = Client::orderBy('company_name','asc')->pluck('company_name','id');

		if($id){
			// $client = Client::where('id',$id)->pluck('company_name','id');
			$client = Client::findOrFail($id);
			// dd($client);
			return view('invoicer.invoices.create', compact('products','clients','client'));
		}

		return view('invoicer.invoices.create', compact('products','clients'));
		

		
	}


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝   
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
	public function destroy($id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_delete')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::find($id);
		$invoice->delete();

		Session::flash('danger','The invoice was deleted successfully.');
		return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ███████╗██████╗ ██╗████████╗
# ██╔════╝██╔══██╗██║╚══██╔══╝
# █████╗  ██║  ██║██║   ██║   
# ██╔══╝  ██║  ██║██║   ██║   
# ███████╗██████╔╝██║   ██║   
# ╚══════╝╚═════╝ ╚═╝   ╚═╝   
// Show the form for editing the specified resource
##################################################################################################################
	public function edit($id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::with('InvoiceItems')->find($id);
		// dd($invoice);
		$clients = Client::orderBy('company_name','asc')->pluck('company_name','id');
		//$invoiceitems = InvoiceItem::where('invoice_id', $invoice->id);
		//dd($invoiceitems);

		return view('invoicer.invoices.edit', compact('invoice','clients'));
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
		if(!checkPerm('invoicer_invoice_index')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));

		return view('invoicer.invoices.index', compact('invoices'));
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
	  if(!checkPerm('invoicer_invoice_index')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()->where('status','=','invoiced')->orderBy('id','desc')->paginate(Config::get('settings.rowsPerPage'));

		return view('invoicer.invoices.index', compact('invoices'));
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
	  if(!checkPerm('invoicer_invoice_index')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()
			->where('status','=','logged')
			->orderBy('id','desc')
			->paginate(Config::get('settings.rowsPerPage'));
			
		return view('invoicer.invoices.index', compact('invoices'));
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
	  if(!checkPerm('invoicer_invoice_index')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::sortable()
			->where('status','=','paid')
			->orderBy('id','desc')
			->paginate(Config::get('settings.rowsPerPage'));

		return view('invoicer.invoices.index', compact('invoices'));
	}


##################################################################################################################
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗
# ██╔════╝██║  ██║██╔═══██╗██║    ██║
# ███████╗███████║██║   ██║██║ █╗ ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
// Display the specified resource
##################################################################################################################
	public function show($id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_show')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::with('invoiceItems')->find($id);

		return view('invoicer.invoices.show', compact('invoice'));
	}


##################################################################################################################
# ███████╗████████╗ █████╗ ████████╗██╗   ██╗███████╗    ██╗███╗   ██╗██╗   ██╗ ██████╗ ██╗ ██████╗███████╗██████╗ 
# ██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║██╔════╝    ██║████╗  ██║██║   ██║██╔═══██╗██║██╔════╝██╔════╝██╔══██╗
# ███████╗   ██║   ███████║   ██║   ██║   ██║███████╗    ██║██╔██╗ ██║██║   ██║██║   ██║██║██║     █████╗  ██║  ██║
# ╚════██║   ██║   ██╔══██║   ██║   ██║   ██║╚════██║    ██║██║╚██╗██║╚██╗ ██╔╝██║   ██║██║██║     ██╔══╝  ██║  ██║
# ███████║   ██║   ██║  ██║   ██║   ╚██████╔╝███████║    ██║██║ ╚████║ ╚████╔╝ ╚██████╔╝██║╚██████╗███████╗██████╔╝
# ╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝ ╚══════╝    ╚═╝╚═╝  ╚═══╝  ╚═══╝   ╚═════╝ ╚═╝ ╚═════╝╚══════╝╚═════╝ 
##################################################################################################################
	public function status_invoiced($id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::findOrFail($id);
			$invoice->status = 'invoiced';
			$invoice->invoiced_at = Carbon::now();
		$invoice->save();

		// Create PDF file and store it
		$pdf = PDF::loadView('invoicer.invoices.invoicedPDF', ['invoice'=>$invoice]);
		$pdf->save(public_path().'/invoices/'. $invoice->id . '.pdf');

		// Send email
      // Mail::to('stephaneandstacie@gmail.com')->send(new InvoicedPDFMail($invoice));

      // Email PDF to client's email
      Mail::to($invoice->client->email)->send(new InvoicedPDFMail($invoice));

		// Set flash data with success message
		Session::flash ('success', 'This invoice was successfully updated and emailed to the client!');
		// Redirect
		return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ███████╗████████╗ █████╗ ████████╗██╗   ██╗███████╗    ██╗███╗   ██╗██╗   ██╗ ██████╗ ██╗ ██████╗███████╗██████╗      █████╗ ██╗     ██╗     
# ██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║██╔════╝    ██║████╗  ██║██║   ██║██╔═══██╗██║██╔════╝██╔════╝██╔══██╗    ██╔══██╗██║     ██║     
# ███████╗   ██║   ███████║   ██║   ██║   ██║███████╗    ██║██╔██╗ ██║██║   ██║██║   ██║██║██║     █████╗  ██║  ██║    ███████║██║     ██║     
# ╚════██║   ██║   ██╔══██║   ██║   ██║   ██║╚════██║    ██║██║╚██╗██║╚██╗ ██╔╝██║   ██║██║██║     ██╔══╝  ██║  ██║    ██╔══██║██║     ██║     
# ███████║   ██║   ██║  ██║   ██║   ╚██████╔╝███████║    ██║██║ ╚████║ ╚████╔╝ ╚██████╔╝██║╚██████╗███████╗██████╔╝    ██║  ██║███████╗███████╗
# ╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝ ╚══════╝    ╚═╝╚═╝  ╚═══╝  ╚═══╝   ╚═════╝ ╚═╝ ╚═════╝╚══════╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
	public function status_invoiced_all()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::where('status', '=', 'logged')->get();
			
			foreach($invoices as $invoice) {
				$invoice->status = 'invoiced';
				$invoice->invoiced_at = Carbon::now();
				$invoice->save();

				// Create PDF file and store it
				$pdf = PDF::loadView('invoicer.invoices.invoicedPDF', ['invoice'=>$invoice]);
				$pdf->save(public_path().'/invoices/'. $invoice->id . '.pdf');

				// Send email
		      // Mail::to('stephaneandstacie@gmail.com')->send(new InvoicedPDFMail($invoice));

		      // Email PDF to client's email
		      Mail::to($invoice->client->email)->send(new InvoicedPDFMail($invoice));
			}

		// Set flash data with success message
		Session::flash ('success', 'All logged invoices have successfully been marked as invoiced!');

		// Redirect to posts.show
		return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ███████╗████████╗ █████╗ ████████╗██╗   ██╗███████╗    ██████╗  █████╗ ██╗██████╗ 
# ██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║██╔════╝    ██╔══██╗██╔══██╗██║██╔══██╗
# ███████╗   ██║   ███████║   ██║   ██║   ██║███████╗    ██████╔╝███████║██║██║  ██║
# ╚════██║   ██║   ██╔══██║   ██║   ██║   ██║╚════██║    ██╔═══╝ ██╔══██║██║██║  ██║
# ███████║   ██║   ██║  ██║   ██║   ╚██████╔╝███████║    ██║     ██║  ██║██║██████╔╝
# ╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝ ╚══════╝    ╚═╝     ╚═╝  ╚═╝╚═╝╚═════╝
##################################################################################################################
	public function status_paid($id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::findOrFail($id);
			$invoice->status = 'paid';
			$invoice->paid_at = Carbon::now();
		$invoice->save();

		// Set flash data with success message
		Session::flash ('success', 'This invoice was successfully updated!');

		// Redirect to posts.show
		return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ███████╗████████╗ █████╗ ████████╗██╗   ██╗███████╗    ██████╗  █████╗ ██╗██████╗      █████╗ ██╗     ██╗     
# ██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║██╔════╝    ██╔══██╗██╔══██╗██║██╔══██╗    ██╔══██╗██║     ██║     
# ███████╗   ██║   ███████║   ██║   ██║   ██║███████╗    ██████╔╝███████║██║██║  ██║    ███████║██║     ██║     
# ╚════██║   ██║   ██╔══██║   ██║   ██║   ██║╚════██║    ██╔═══╝ ██╔══██║██║██║  ██║    ██╔══██║██║     ██║     
# ███████║   ██║   ██║  ██║   ██║   ╚██████╔╝███████║    ██║     ██║  ██║██║██████╔╝    ██║  ██║███████╗███████╗
# ╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝ ╚══════╝    ╚═╝     ╚═╝  ╚═╝╚═╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
	public function status_paid_all()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoices = Invoice::where('status', '=', 'invoiced')->get();
			
			foreach($invoices as $invoice) {
				$invoice->status = 'paid';
				$invoice->paid_at = Carbon::now();
				$invoice->save();
			}

		// Set flash data with success message
		Session::flash ('success', 'All invoiced invoices have successfully been marked as paid!');

		// Redirect to posts.show
		return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Store a newly created resource in storage
##################################################################################################################
	public function store(Request $request)
	{
		// validate the data
		$this->validate($request, [
			'client_id' => 'required',
			// 'work_date' => 'required',
			'status' => 'required'
		]);

		// save the data in the database
		$invoice = new Invoice;
			// $invoice->work_date = $request->work_date;
			$invoice->client_id = $request->client_id;
			$invoice->notes = $request->notes;
			$invoice->status = $request->status;
			if($request->status == 'invoiced')
			{
				$invoice->invoiced_at = Carbon::now();
			}
		$invoice->save();

		// Add items to InvoiceItem table
		if($request->invoiceItem) {
			foreach($request->invoiceItem as $data)
			{
				$item = new InvoiceItem($data);
					$item->invoice_id = $invoice->id;
				$item->save();
			}
		}

		// set a flash message to be displayed on screen
		Session::flash('success','The invoice was successfully saved!');

		// redirect to another page
	   return redirect()->route('invoicer.invoices');
	}


##################################################################################################################
# ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
# ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
# ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
# ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
# ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
#  ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
// UPDATE :: Update the specified resource in storage
##################################################################################################################
	public function update(Request $request, $id)
	{
		// validate the data
		$this->validate($request,
			[
				'client_id' => 'required',
				'status' => 'required',
			]);

		$invoice = Invoice::find($id);
			// $invoice->work_date = $request->work_date;
			$invoice->client_id = $request->client_id;
			$invoice->notes = $request->notes;
			$invoice->status = $request->status;
			$invoice->invoiced_at = $request->invoiced_at;
			$invoice->paid_at = $request->paid_at;

			// Perform required calculations
			// $inv_amount_charged = DB::table('invoicer.invoiceitems')->where('invoice_id', '=', $invoice->id)->sum('total');
			// $inv_hst = $inv_amount_charged * Config::get('invoicer.hst_rate');
			// $inv_sub_total = $inv_amount_charged + $inv_hst;
			// $inv_wsib = $inv_amount_charged * Config::get('invoicer.wsib_rate');
			// $inv_income_taxes = $inv_amount_charged * Config::get('invoicer.income_tax_rate');
			// $inv_total_deductions = $inv_wsib + $inv_income_taxes;
			// $inv_total = $inv_amount_charged - $inv_total_deductions;
			
			// // Set the values to be updated
			// $invoice->amount_charged = $inv_amount_charged;
			// $invoice->hst = $inv_hst;
			// $invoice->sub_total = $inv_sub_total;
			// $invoice->wsib = $inv_wsib;
			// $invoice->income_taxes = $inv_income_taxes;
			// $invoice->total_deductions = $inv_total_deductions;
			// $invoice->total = $inv_total;
		$invoice->save();

		// Set flash data with success message
		Session::flash ('info', 'This invoice was successfully updated!');

		// Redirect to posts.show
		return redirect()->route('invoicer.invoices');
	}


}
