<?php

namespace App\Http\Controllers;

use Artisan;
use DB;
use Hash;
use Session;
use App\Permission;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class UsersController extends Controller
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
		// Set the variable so we can use a button in other pages to come back to this page
		Session::put('pageName', 'index');

		// Check if user has required permission
		if(!checkPerm('user_index')) { abort(401, 'Unauthorized Access'); }

		$users = User::orderby('username', 'asc')->get();
		return view('users.index', compact('users'));
	}


##################################################################################################################
#  ██████╗██╗  ██╗ █████╗ ███╗   ██╗ ██████╗ ███████╗    ██████╗ ██╗    ██╗██████╗ 
# ██╔════╝██║  ██║██╔══██╗████╗  ██║██╔════╝ ██╔════╝    ██╔══██╗██║    ██║██╔══██╗
# ██║     ███████║███████║██╔██╗ ██║██║  ███╗█████╗      ██████╔╝██║ █╗ ██║██║  ██║
# ██║     ██╔══██║██╔══██║██║╚██╗██║██║   ██║██╔══╝      ██╔═══╝ ██║███╗██║██║  ██║
# ╚██████╗██║  ██║██║  ██║██║ ╚████║╚██████╔╝███████╗    ██║     ╚███╔███╔╝██████╔╝
#  ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝    ╚═╝      ╚══╝╚══╝ ╚═════╝
##################################################################################################################
	public function changeUserPWD($id)
	{
		// Check if user has required user
		// if(!checkPerm('change_user_pwd')) { abort(401, 'Unauthorized Access'); }

		$user = User::findOrFail($id);
		return view('users.changeUserPWD', compact('user'));
	}

	public function changeUserPWDPost(Request $request, $id)
	{
		// Allows an admin to change user account passwords

		// Check if user has required user
		//if(!checkPerm('change_user_pwd')) { abort(401, 'Unauthorized Access'); }

		$this->validate($request, [
			'password' => 'required|confirmed|min:6',
		]);

		$user = User::findOrFail($id);
			$user->password = Hash::make($request->password);
		$user->save();

		return redirect()->route('users.index')->with('success','User\'s password updated successfully');
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
		if(!checkPerm('user_create')) { abort(401, 'Unauthorized Access'); }
		
		// Get all active modules
		$modules = \Module::allEnabled();

		// Create empty array to store module groups
		$moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		foreach($modules as $mod) {
			$moduleName = strtolower(str_singular($mod->name));
			array_push($moduleGroups, $moduleName);
		}

		// Get all permissions based on modules
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');
		
		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',0)->orderBy('model','asc')->get();
		$nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)->orderBy('model')->orderBy('display_name')->get();
		$nonCoreGroups = $nonCorePermissions->groupBy('model');

		return view('users.create', compact('modulePermissions','moduleGroups','corePermissions','coreGroups','nonCorePermissions','nonCoreGroups'));
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
	public function delete(User $user)
	{
		// Check if user has required user
		if(!checkPerm('user_delete')) { abort(401, 'Unauthorized Access'); }

		$user = User::findOrFail($user->id);
		return view('users.delete', compact('user'));
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
	public function destroy(User $user)
	{
		// Check if user has required user
		//if(!checkPerm('user_delete')) { abort(401, 'Unauthorized Access'); }

		// Find the user to be deleted
		$user = User::find($user->id);
		
		// Delete the permissions assigned to this user
		// $user->permissions()->delete(); No need to do this as this is done in the migration file with the foreign key

		// Delete the user
		$user->profile->delete();
		$user->delete();


		// Set flash data with success message
		Session::flash('delete','The user was deleted successfully.');

		// Redirect
		return redirect()->route('users.index');
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
		if(!checkPerm('user_edit')) { abort(401, 'Unauthorized Access'); }
		
		$user = User::find($id);
		// Get all active modules
		$modules = \Module::allEnabled();

		// Create empty array to store module groups
		$moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		foreach($modules as $mod) {
			$moduleName = strtolower(str_singular($mod->name));
			array_push($moduleGroups, $moduleName);
		}

		// Get all permissions based on modules
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as admin
		// $adminGroups = Permission::select('model')->distinct()->where('type',2)->orderBy('model','asc')->get();
		// $adminPermissions = Permission::whereIn('model', $adminGroups)->orderBy('model')->orderBy('display_name')->get();
		// $adminGroups = $adminPermissions->groupBy('model');

		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',0)->orderBy('model','asc')->get();
		$nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)->orderBy('model')->orderBy('display_name')->get();
		$nonCoreGroups = $nonCorePermissions->groupBy('model');

		// Get the permissions currently assigned to this user
		$userPermissions = DB::table("permission_user")
			->where("permission_user.user_id",$id)
			->pluck('permission_user.permission_id','permission_user.permission_id')
			->all();

		return view('users.edit', compact('user','corePermissions','coreGroups','modulePermissions','moduleGroups','userPermissions','nonCorePermissions','nonCoreGroups'));
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
		if(!checkPerm('user_show')) { abort(401, 'Unauthorized Access'); }
		
		$user = User::find($id);
		// Get all active modules
		$modules = \Module::allEnabled();

		// Create empty array to store module groups
		$moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		foreach($modules as $mod) {
			$moduleName = strtolower(str_singular($mod->name));
			array_push($moduleGroups, $moduleName);
		}

		// Get all permissions based on modules
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as admin
		// $adminGroups = Permission::select('model')->distinct()->where('type',2)->orderBy('model','asc')->get();
		// $adminPermissions = Permission::whereIn('model', $adminGroups)->orderBy('model')->orderBy('display_name')->get();
		// $adminGroups = $adminPermissions->groupBy('model');

		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',0)->orderBy('model','asc')->get();
		$nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)->orderBy('model')->orderBy('display_name')->get();
		$nonCoreGroups = $nonCorePermissions->groupBy('model');

		// Get the permissions currently assigned to this user
		$userPermissions = DB::table("permission_user")
			->where("permission_user.user_id",$id)
			->pluck('permission_user.permission_id','permission_user.permission_id')
			->all();

		return view('users.show', compact('user','corePermissions','coreGroups','modulePermissions','moduleGroups','userPermissions','nonCorePermissions','nonCoreGroups'));
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
		$this->validate($request, [
			'username' => 'required',
			'email' => 'required|email|unique:users,email',
			'permission' => 'sometimes',
		]);

		$user = User::create([
			'username' => $request->input('username'),
			'email' => $request->input('email'),
			// 'password' => bcrypt('password')
			'password' => Hash::make($request->password)
		]);

		$user->permissions()->attach($request->input('permission'));
		$user->profile()->save(new Profile);
		// Profile::create(['user_id' => $user->id]);

		return redirect()->route('users.index')->with('store','User created successfully');
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
	public function update(Request $request, User $user)
	{
		$this->validate($request, [
			'username' => 'required',
			'email' => 'required|email|unique:users,email,'.$user->id,
			'permission' => 'sometimes',
		]);

		$user = User::findOrFail($user->id);
			$user->username = $request->input('username');
			$user->email = $request->input('email');
		$user->save();

		$user->permissions()->sync($request->input('permission'));

		if($request->submit == "close")
		{
			return redirect()->route('users.index')->with('update','User updated successfully');
		} else {
			return redirect()->route('users.edit', $user->id)->with('update','User updated successfully');
		}
	}


}
