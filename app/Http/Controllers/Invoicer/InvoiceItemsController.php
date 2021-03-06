<?php

namespace App\Http\Controllers\Invoicer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Invoicer\InvoiceItem;
use App\Models\Invoicer\Invoice;
use App\Models\Invoicer\Product;
use Session;
use Config;
use DB;

class InvoiceItemsController extends Controller
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
	public function create($inv_id)
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$invoice = Invoice::findOrFail($inv_id);
		$products = Product::orderBy('code', 'asc')->pluck('code','id');
		// $products = Product::orderBy('code', 'asc')->get()->toArray();

		return view('invoicer.invoiceItems.create', compact('invoice', 'products'));
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
	  if(!checkPerm('invoicer_invoice_edit')) { abort(401, 'Unauthorized Access'); }

		$item = InvoiceItem::find($id);
		$invoice_id = $item->invoice_id;
		$item->delete();

		// update invoice with totals
		$this::invUpdate($invoice_id);

		// set a flash message to be displayed on screen
		Session::flash('danger','The billable item was deleted successfully.');

		// redirect to another page
		return redirect()->route('invoicer.invoices.edit', $item->invoice_id );
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

		$item = InvoiceItem::find($id);
		$products = Product::orderBy('code', 'asc')->pluck('code','id');
		
		return view('invoicer.invoiceItems.edit', compact('item','products'));
	}


##################################################################################################################
# ██╗███╗   ██╗██╗   ██╗ ██████╗ ██╗ ██████╗███████╗    ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
# ██║████╗  ██║██║   ██║██╔═══██╗██║██╔════╝██╔════╝    ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
# ██║██╔██╗ ██║██║   ██║██║   ██║██║██║     █████╗      ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
# ██║██║╚██╗██║╚██╗ ██╔╝██║   ██║██║██║     ██╔══╝      ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
# ██║██║ ╚████║ ╚████╔╝ ╚██████╔╝██║╚██████╗███████╗    ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
# ╚═╝╚═╝  ╚═══╝  ╚═══╝   ╚═════╝ ╚═╝ ╚═════╝╚══════╝     ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
	public function invUpdate($invID)
	{
		// update invoice with totals
		$invoice = Invoice::find($invID);
			 // Perform required calculations
			$inv_amount_charged = DB::table('invoicer__invoice_items')->where('invoice_id', '=', $invoice->id)->sum('total');
			$inv_hst = $inv_amount_charged * Setting('invoicer.hstRate');
			$inv_sub_total = $inv_amount_charged + $inv_hst;
			$inv_wsib = $inv_amount_charged * Setting('invoicer.wsibRate');
			$inv_income_taxes = $inv_amount_charged * Setting('invoicer.incomeTaxRate');
			$inv_total_deductions = $inv_wsib + $inv_income_taxes;
			$inv_total = $inv_amount_charged - $inv_total_deductions;
			
			// Set the values to be updated
			$invoice->amount_charged = $inv_amount_charged;
			$invoice->hst = $inv_hst;
			$invoice->sub_total = $inv_sub_total;
			$invoice->wsib = $inv_wsib;
			$invoice->income_taxes = $inv_income_taxes;
			$invoice->total_deductions = $inv_total_deductions;
			$invoice->total = $inv_total;
		$invoice->save();
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
			'product_id' => 'required',
			'work_date' => 'required',
			'quantity' => 'required',
			'price' => 'required'
		]);

		$item = new InvoiceItem;
			$item->invoice_id = $request->invoice_id;
			$item->product_id = $request->product_id;
			$item->notes = $request->notes;
			$item->work_date = $request->work_date;
			$item->quantity = $request->quantity;
			$item->price = $request->price;
			$item->total = $request->quantity * $request->price;
		$item->save();

		// // update invoice with totals
		$this::invUpdate($request->invoice_id);
		// \App\Invoice::update($request->invoice_id);

		// set a flash message to be displayed on screen
		Session::flash('success','The billable item was successfully added!');

		// redirect to another page
	   return redirect()->route('invoicer.invoices.edit', $item->invoice_id);
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
		$this->validate($request, [
			'product_id' => 'required',
			'work_date' => 'required',
			'quantity' => 'required',
			'price' => 'required'
		]);

		$item = InvoiceItem::find($id);
			$item->invoice_id = $request->invoice_id;
			$item->product_id = $request->product_id;
			$item->notes = $request->notes;
			$item->work_date = $request->work_date;
			$item->quantity = $request->quantity;
			$item->price = $request->price;
			$item->total = $request->quantity * $request->price;
		$item->save();

		// update invoice with totals
		$this::invUpdate($request->invoice_id);

		// set a flash message to be displayed on screen
		Session::flash('info','The billable item was updated successfully!');

	   // redirect to another page
	   return redirect()->route('invoicer.invoices.edit', $item->invoice_id);
	}


}
