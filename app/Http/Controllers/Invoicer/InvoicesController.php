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
use App\Models\User;
use App\Mail\Invoicer\InvoicedPDFMail;
use carbon\Carbon;
use Config;
use DB;
use PDF;
use Session;
use Storage;

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
     $this->enablePermissions = false;
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
		// $clients = Client::orderBy('company_name','asc')->pluck('company_name','id');
		$clients = User::orderBy('company_name','asc')->pluck('company_name','id');
		// dd($clients);

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
# ██████╗  ██████╗ ██╗    ██╗███╗   ██╗██╗      ██████╗  █████╗ ██████╗     ██████╗ ██████╗ ███████╗
# ██╔══██╗██╔═══██╗██║    ██║████╗  ██║██║     ██╔═══██╗██╔══██╗██╔══██╗    ██╔══██╗██╔══██╗██╔════╝
# ██║  ██║██║   ██║██║ █╗ ██║██╔██╗ ██║██║     ██║   ██║███████║██║  ██║    ██████╔╝██║  ██║█████╗  
# ██║  ██║██║   ██║██║███╗██║██║╚██╗██║██║     ██║   ██║██╔══██║██║  ██║    ██╔═══╝ ██║  ██║██╔══╝  
# ██████╔╝╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗╚██████╔╝██║  ██║██████╔╝    ██║     ██████╔╝██║     
# ╚═════╝  ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═════╝     ╚═╝     ╚═════╝ ╚═╝     
##################################################################################################################

	public function downloadInvoice($id)
	{
		// 
		$file = public_path('invoices') . '\\' . $id . '.pdf'; // or wherever you have stored your PDF files
   	return response()->download($file);
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
		// $clients = Client::orderBy('company_name','asc')->pluck('company_name','id');
		$clients = User::orderBy('company_name','asc')->pluck('company_name','id');
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

		$invoices = Invoice::sortable()
			->where('status','=','invoiced')
			->orderBy('id','desc')
			->paginate(Config::get('settings.rowsPerPage'));

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
      Mail::to($invoice->user->email)->send(new InvoicedPDFMail($invoice));

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
		      Mail::to($invoice->user->email)->send(new InvoicedPDFMail($invoice));
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
			// $invoice->client_id = $request->client_id;
			$invoice->user_id = $request->client_id;
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
				'user_id'		=> 'required',
				'status'			=> 'required',
				'paid_at'		=> 'required_if:status,==,paid',
				'invoiced_at'	=> 'required_if:status,==,invoiced',
			]);

		$invoice = Invoice::find($id);
		
			// Get value of original Status
			$ori_status = $invoice->status;

			// If status is changed form Paid to Invoiced
			if($ori_status == 'paid' && $request->status == 'invoiced' ) {
				// Clear the value of paid_at field
				$invoice->paid_at = null;

			// If status is changed from Paid to Logged
			}elseif($ori_status == 'paid' && $request->status == 'logged' ){
				// Clear the value of the paid_at and invoiced_at fields
				$invoice->paid_at = null;
				$invoice->invoiced_at = null;

			// If status is changed from Invoiced to Logged
			}elseif($ori_status == 'invoiced' && $request->status == 'logged' ){
				// Clear the value of the invoiced_at field
				$invoice->invoiced_at = null;

			// If status is cahnged form Logged to Invoiced
			}elseif($ori_status == 'logged' && $request->status == 'invoiced' ){
				// Set the value of invoiced_at to the value passed from the form
				$invoice->invoiced_at = $request->invoiced_at;

			// If status is changed from Invoiced to Paid
			}elseif($ori_status == 'invoiced' && $request->status == 'paid' ){
				// Set the value of paid_at to the value passed from the form
				$invoice->paid_at = $request->paid_at;
			}

			// Update the rest of the fields
			// $invoice->client_id = $request->client_id;
			$invoice->user_id = $request->user_id;
			$invoice->notes = $request->notes;
			$invoice->status = $request->status;

		// Update the invoice
		$invoice->save();

		// Set flash data with success message
		Session::flash ('info', 'This invoice was successfully updated!');

		// Redirect to invoices.index
		return redirect()->route('invoicer.invoices');
	}


}
