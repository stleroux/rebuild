<?php

namespace App\Http\Controllers\Invoicer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Invoicer\Product;
use Config;
use Session;

class ProductsController extends Controller
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
	public function create()
	{
		// Check if user has required permission
	  if(!checkPerm('invoicer_product_create')) { abort(401, 'Unauthorized Access'); }

		return view('invoicer.products.create');
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
	  if(!checkPerm('invoicer_product_delete')) { abort(401, 'Unauthorized Access'); }

		$product = Product::find($id);
		$product->delete();

		// Set flash data with success message
		Session::flash('danger','The product was deleted successfully.');

		// Redirect
		return redirect()->route('invoicer.products');
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
	  if(!checkPerm('invoicer_product_edit')) { abort(401, 'Unauthorized Access'); }

		$product = Product::findOrFail($id);
		
		return view('invoicer.products.edit', compact('product'));
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
	  if(!checkPerm('invoicer_product_index')) { abort(401, 'Unauthorized Access'); }

		$products = Product::sortable()
			->orderBy('code','asc')
			->paginate(Config::get('settings.rowsPerPage'));

		return view('invoicer.products.index', compact('products'));
	}


##################################################################################################################
# ███████╗███████╗ █████╗ ██████╗  ██████╗██╗  ██╗
# ██╔════╝██╔════╝██╔══██╗██╔══██╗██╔════╝██║  ██║
# ███████╗█████╗  ███████║██████╔╝██║     ███████║
# ╚════██║██╔══╝  ██╔══██║██╔══██╗██║     ██╔══██║
# ███████║███████╗██║  ██║██║  ██║╚██████╗██║  ██║
# ╚══════╝╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝╚═╝  ╚═╝
##################################################################################################################
	public function search(Request $request)
	{
		//dd($request->q);
		if($request->selection == 'code') {
			$products = Product::where('code', 'like', '%' . $request->searchWord . '%')->paginate(10);
		}

		if($request->selection == 'details') {
			$products = Product::where('details', 'like', '%' . $request->searchWord . '%')->paginate(10);
		}
		
		return view('invoicer.products.index', compact('products'));
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
	  if(!checkPerm('invoicer_product_show')) { abort(401, 'Unauthorized Access'); }

		$product = Product::findOrFail($id);

		return view('invoicer.products.show', compact('product'));
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
		$this->validate($request, array(
			'code' => 'required|unique:invoicer_products,code',
			'details' => 'required',
		));

		// save the data in the database
		$product = new Product;
			$product->code = $request->code;
			$product->details = $request->details;
		$product->save();

		// set a flash message to be displayed on screen
		Session::flash('success','The product was successfully saved!');

		// redirect to another page
	   return redirect()->route('invoicer.products');
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
		$this->validate($request, array(
			'code' => 'required|unique:invoicer_products,code,' . $id,
			// 'code' => 'required',
			'details' => 'required',
		));

		$product = Product::find($id);
			$product->code = $request->code;
			$product->details = $request->details;
		$product->save();
		
		// Set flash data with success message
		Session::flash ('info', 'The product was successfully updated!');

		// Redirect
		return redirect()->route('invoicer.products');
	}


}
