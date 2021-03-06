<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;

class PermissionsController extends Controller
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
      $this->enablePermissions = true;
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
		if($this->enablePermissions) {
			if(!checkPerm('permission_add')) { abort(401, 'Unauthorized Access'); }
		}

		$permission = New Permission();

		return view('admin.permissions.create', compact('permission'));
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
	public function delete($id)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('permission_delete')) { abort(401, 'Unauthorized Access'); }
		}

		$permission = Permission::findOrFail($id);
		return view('admin.permissions.delete', compact('permission'));
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
		if($this->enablePermissions) {
			if(!checkPerm('permission_delete')) { abort(401, 'Unauthorized Access'); }
		}

		$permission = Permission::find($id);
		$permission->delete();

		// Set flash data with success message
		Session::flash('success','The permission was deleted successfully.');

		// Redirect
		return redirect()->route('admin.permissions.index');
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
		if($this->enablePermissions) {
			if(!checkPerm('permission_edit')) { abort(401, 'Unauthorized Access'); }
		}

		$permission = Permission::findOrFail($id);
		return view('admin.permissions.edit', compact('permission')); 
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
		if($this->enablePermissions) {
			if(!checkPerm('permission_browse')) { abort(401, 'Unauthorized Access'); }
		}

		$permissions = Permission::orderBy('name')->get();
		return view('admin.permissions.index', compact('permissions'));
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
		if($this->enablePermissions) {
			if(!checkPerm('permission_read')) { abort(401, 'Unauthorized Access'); }
		}

		$permission = Permission::findOrFail($id);
		return view('admin.permissions.show', compact('permission'));
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
	// public function store(CreatePermissionRequest $request, Permission $permission)
	public function store(Request $request, Permission $permission)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('permission_add')) { abort(401, 'Unauthorized Access'); }
		}

		if($request->bread){
			$rules = [
            'b_model' => 'required',
      	];

        	$customMessages = [
            'b_model.required' => 'The model field can not be left blank.',
        	];

        	$this->validate($request, $rules, $customMessages);

        	$bread = ['browse','read','edit','add','delete'];
        	// $bread = ['index','create','read','update','delete'];

        	// save the data in the database
			foreach($bread as $b){
				$permission = new Permission;
					$permission->name = str::singular($request->b_model) . "_" . $b;
					$permission->display_name = ucfirst($b);
					$permission->model = str::singular($request->b_model);
					$permission->description = $b . " " . $request->b_model;
				$permission->save();
			}

		} else {
			
			$rules = [
            'name' => 'required',
            'display_name' => 'required',
            'model' => 'required',
            'description' => 'required',
      	];

        	$customMessages = [
            'name.required' => 'The :attribute field can not be left blank.',
            'display_name.required' => 'The :attribute field is required.',
            'model.required' => 'The :attribute field is required.',
            'description.required' => 'The :attribute field is required.',
        	];

        	$this->validate($request, $rules, $customMessages);

			// save the data in the database
			$permission = new Permission;
				$permission->name = $request->name;
				$permission->display_name = $request->display_name;
				$permission->model = str::singular($request->model);
				$permission->description = $request->description;
			$permission->save();
		}

		// set a flash message to be displayed on screen
		Session::flash('store','The permission was successfully saved!');

		if($request->submit == 'new')
		{
			return redirect()->route('admin.permissions.create');
		} else {
			return redirect()->route('admin.permissions.index');
		}
		
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
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('permission_edit')) { abort(401, 'Unauthorized Access'); }
		}
		$rules = [
         'name' => 'required',
         'display_name' => 'required',
         'model' => 'required',
         'description' => 'required',
   	];

     	$customMessages = [
         'name.required' => 'The :attribute field can not be left blank.',
         'display_name.required' => 'The :attribute field is required.',
         'model.required' => 'The :attribute field is required.',
         'description.required' => 'The :attribute field is required.',
     	];

     	$this->validate($request, $rules, $customMessages);

		// save the data in the database
		$permission = Permission::findOrFail($id);
			// $permission->name = $request->name;
			$permission->display_name = $request->display_name;
			$permission->model = $request->model;
			$permission->description = $request->description;
		$permission->save();

		// set a flash message to be displayed on screen
		Session::flash('update','The permission was updated successfully!');

		// redirect to another page
	   return redirect()->route('admin.permissions.index');
	}


}
