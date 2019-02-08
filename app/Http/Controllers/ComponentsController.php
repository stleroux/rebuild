<?php

namespace App\Http\Controllers;

// use App\Module;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests\CreateComponentRequest;

class ComponentsController extends Controller
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
		if(!checkPerm('component_index')) { abort(401, 'Unauthorized Access'); }

		$modules = \Module::all();
		// dd($modules);
		return view('components.index', compact('modules'));
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
		if(!checkPerm('component_create')) { abort(401, 'Unauthorized Access'); }

		return view('components.create');
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
	public function store(CreateComponentRequest $request)
	{
		$this->validate($request, [
			'name' => 'required',
		]);

		// dd($request);
		// $name = $request->name;
		// dd(\Artisan::call('module:make ' . $name));

		\Artisan::call('module:make', ['name'=>[$request->name]]);
		// $commandArgument = $request->get('name');

		// return $this->runCommand('module:make', $commandArgument);

		// Set flash data with success message
		Session::flash('store','The component ' . $request->name . ' was created successfully.');
		return redirect()->route('components.index');
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
	public function show(Module $module)
	{
		//
	}

	


	public function enableModule($module)
	{
		// Check if user has required permission
		if(!checkPerm('component_enable')) { abort(401, 'Unauthorized Access'); }

		// \Artisan::call('module:enable', ['module'=>$module]);
		$module = \Module::find($module);
		$module->enable();

		// Set flash data with success message
		Session::flash('success','The component was enabled successfully.');
		return redirect()->back();
	}


	public function disableModule($module)
	{
		// Check if user has required permission
		if(!checkPerm('component_disable')) { abort(401, 'Unauthorized Access'); }

		// \Artisan::call('module:disable', ['module'=>$module]);
		$module = \Module::find($module);
		$module->disable();

		// Set flash data with success message
		Session::flash('success','The component was disabled successfully.');
		return redirect()->back();
	}


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
// Mass Delete selected rows - all selected records
##################################################################################################################
	public function deleteModule($module)
	{
		// Check if user has required permission
		if(!checkPerm('component_delete')) { abort(401, 'Unauthorized Access'); }

		$module = \Module::find($module);
		return view('components.delete', compact('module'));
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
	public function deleteModulePost($module)
	{
		// Check if user has required permission
		if(!checkPerm('component_delete')) { abort(401, 'Unauthorized Access'); }

		// \Artisan::call('module:disable', ['module'=>$module]);
		$module = \Module::find($module);
		// dd($module);
		$module->delete();
		// Set flash data with success message
		Session::flash('delete','The component was deleted successfully.');
		return redirect()->route('components.index');
	}

}


// \Artisan::call('module:migrate', ['name'=>[$request->name]]);
// if($request->seed) {
//     \Artisan::call('module:seed', ['name'=>[$request->name]]);
// }