<?php

namespace App\Modules\Invoicer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Invoicer\Models\Client;
use Config;
use Session;


class ClientsController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth');
   }


	public function index()
	{
		$clients = Client::sortable()
			->orderBy('company_name','asc')
			->paginate(Config::get('settings.rowsPerPage'));
		return view('Invoicer::clients.index', compact('clients'));
	}


	public function create()
	{
		return view('Invoicer::clients.create');
	}


	public function store(Request $request)
	{
		// validate the data
		$this->validate($request, array(
			'company_name' => 'required',
			'contact_name' => 'required',
		));

		// save the data in the database
		$client = new client;
			$client->company_name = $request->company_name;
			$client->contact_name = $request->contact_name;
			$client->address = $request->address;
			$client->city = $request->city;
			$client->state = $request->state;
			$client->zip = $request->zip;
			$client->notes = $request->notes;
			$client->telephone = $request->telephone;
			$client->cell = $request->cell;
			$client->fax = $request->fax;
			$client->email = $request->email;
			$client->website = $request->website;
			// $client->user_id = 1;
		$client->save();

		// set a flash message to be displayed on screen
		Session::flash('success','The client was successfully saved!');

		// redirect to another page
	   return redirect()->route('invoicer.clients');
	}


	public function show($id)
	{
		$client = Client::findOrFail($id);
		return view('Invoicer::clients.show', compact('client'));
	}


	public function edit($id)
	{
		$client = Client::findOrFail($id);
		return view('Invoicer::clients.edit', compact('client'));
	}


	public function update(Request $request, $id)
	{
		// validate the data
		$this->validate($request, array(
			'company_name' => 'required',
			'contact_name' => 'required',
		));

		$client = Client::find($id);
			$client->company_name = $request->company_name;
			$client->contact_name = $request->contact_name;
			$client->address = $request->address;
			$client->city = $request->city;
			$client->state = $request->state;
			$client->zip = $request->zip;
			$client->notes = $request->notes;
			$client->telephone = $request->telephone;
			$client->cell = $request->cell;
			$client->fax = $request->fax;
			$client->email = $request->email;
			$client->website = $request->website;
		$client->save();
		
		// Set flash data with success message
		Session::flash ('success', 'The client was successfully updated!');

		// Redirect
		return redirect()->route('invoicer.clients');
	}


	public function destroy($id)
	{
		$client = Client::find($id);
		$client->delete();

		// Set flash data with success message
		Session::flash('success','The client was deleted successfully.');

		// Redirect
		return redirect()->route('invoicer.clients');
	}
	

	public function search(Request $request)
	{
		//dd($request->q);
		if($request->selection == 'company') {
			$clients = Client::where('company_name', 'like', '%' . $request->searchWord . '%')->paginate(10);
		}

		if($request->selection == 'contact') {
			$clients = Client::where('contact_name', 'like', '%' . $request->searchWord . '%')->paginate(10);
		}
		
		return view('Invoicer::clients.index', compact('clients'));
	}
	
}
