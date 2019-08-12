<?php

namespace App\Http\Controllers\Users;

use Artisan;
use DB;
use File;
use Hash;
use Image;
use Route;
use Session;
use App\Http\Controllers\Controller; 
use App\Models\Permission;
use App\Models\User;
use App\Models\Profile;
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
      $this->enablePermissions = false;
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
		// Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

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


##################################################################################################################
##################################################################################################################
# Change User PWD Post
##################################################################################################################
##################################################################################################################
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
		// $modules = \Module::allEnabled();

		// Create empty array to store module groups
		// $moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		// foreach($modules as $mod) {
		// 	$moduleName = strtolower(str_singular($mod->name));
		// 	array_push($moduleGroups, $moduleName);
		// }

		// Get all permissions based on modules
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		// $moduleGroups = $modulePermissions->groupBy('model');

		$user = new User();

		// Get permissions of groups identified as module
		$moduleGroups = Permission::select('model')->distinct()->where('type',3)->orderBy('model','asc')->get();
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('model')->orderBy('display_name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');
		
		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',2)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
		$nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)->orderBy('model')->orderBy('display_name')->get();
		$nonCoreGroups = $nonCorePermissions->groupBy('model');

		return view('users.create', compact('modulePermissions','moduleGroups','corePermissions','coreGroups','nonCorePermissions','nonCoreGroups','user'));
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
		// $modules = \Module::allEnabled();

		// Create empty array to store module groups
		// $moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		// foreach($modules as $mod) {
		// 	$moduleName = strtolower(str_singular($mod->name));
		// 	array_push($moduleGroups, $moduleName);
		// }

		// Get all permissions based on modules
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		// $moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as module
		$moduleGroups = Permission::select('model')->distinct()->where('type',3)->orderBy('model','asc')->get();
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('model')->orderBy('display_name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',2)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
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
		// $modules = \Module::allEnabled();

		// Create empty array to store module groups
		// $moduleGroups = [];
		
		// Iterate through active modules and add them to the moduleGroups array
		// foreach($modules as $mod) {
		// 	$moduleName = strtolower(str_singular($mod->name));
		// 	array_push($moduleGroups, $moduleName);
		// }

		// Get all permissions based on modules
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('name')->get();
		// $moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as module
		$moduleGroups = Permission::select('model')->distinct()->where('type',3)->orderBy('model','asc')->get();
		$modulePermissions = Permission::whereIn('model', $moduleGroups)->orderBy('model')->orderBy('display_name')->get();
		$moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as core
		$coreGroups = Permission::select('model')->distinct()->where('type',2)->orderBy('model','asc')->get();
		$corePermissions = Permission::whereIn('model', $coreGroups)->orderBy('model')->orderBy('display_name')->get();
		$coreGroups = $corePermissions->groupBy('model');

		// Get permissions of groups identified as NON core
		$nonCoreGroups = Permission::select('model')->distinct()->where('type',1)->orderBy('model','asc')->get();
		$nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)->orderBy('model')->orderBy('display_name')->get();
		$nonCoreGroups = $nonCorePermissions->groupBy('model');

		// Get the permissions currently assigned to this user
		$userPermissions = DB::table("permission_user")
			->where("permission_user.user_id",$id)
			->pluck('permission_user.permission_id','permission_user.permission_id')
			->all();

		return view('users.show',
			compact(
				'user',
				'corePermissions',
				'coreGroups',
				'userPermissions',
				'nonCorePermissions',
				'nonCoreGroups',
				'moduleGroups',
				'modulePermissions'
			)
		);
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
         $user->public_email = $request->input('public_email');
         $user->first_name = $request->input('first_name');
         $user->last_name = $request->input('last_name');
         $user->telephone = $request->input('telephone');
         $user->cell = $request->input('cell');
         $user->fax = $request->input('fax');
         $user->website = $request->input('website');
         $user->civic_number = $request->input('civic_number');
         $user->address_1 = $request->input('address_1');
         $user->address_2 = $request->input('address_2');
         $user->city = $request->input('city');
         $user->province = $request->input('province');
         $user->postal_code = $request->input('postal_code');
         $user->notes = $request->input('notes');
         $user->action_buttons = $request->input('action_buttons');
         $user->alert_fade_time = $request->input('alert_fade_time');
         $user->author_format = $request->input('author_format');
         $user->date_format = $request->input('date_format');
         $user->landing_page_id = $request->input('landing_page_id');
         $user->rows_per_page = $request->input('rows_per_page');

         // Check if a new image was submitted
         if ($request->hasFile('image')) {
            //Add new photo
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('_profiles/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
               
            // get name of old image
            $oldImageName = $user->image;
               
            // Update database
            $user->image = $filename;

            // Delete old photo
            //Storage::delete($oldImageName);
            File::delete('_profiles/' . $oldImageName);
          }

		$user->save();
		// $user->profile->save();

		$user->permissions()->sync($request->input('permission'));



		if($request->submit == "close")
		{
			return redirect()->route('users.index')->with('update','User updated successfully');
		} else {
			return redirect()->route('users.edit', $user->id)->with('update','User updated successfully');
		}
	}


}
