<?php

namespace App\Http\Controllers\Admin\Users;

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
      $this->enablePermissions = true;
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_browse')) { abort(401, 'Unauthorized Access'); }
      }

		// Set the session to the current page route
      Session::put('fromPage', url()->full());

		$users = User::orderby('username', 'asc')->get();

		return view('admin.users.index', compact('users'));
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_add')) { abort(401, 'Unauthorized Access'); }
      }

		$user = new User();

		// Get permissions of groups identified as module
		// $moduleGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',3)
  //        ->orderBy('model','asc')
  //        ->get();
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $moduleGroups = $modulePermissions->groupBy('model');
		
		// // Get permissions of groups identified as core
		// $coreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',2)
  //        ->orderBy('model','asc')
  //        ->get();
		// $corePermissions = Permission::whereIn('model', $coreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $coreGroups = $corePermissions->groupBy('model');

		// // Get permissions of groups identified as NON core
		// $nonCoreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',1)
  //        ->orderBy('model','asc')
  //        ->get();
		// $nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $nonCoreGroups = $nonCorePermissions->groupBy('model');


      // Get all permissions of groups
      $groups = Permission::select('model')
         ->distinct()
         ->orderBy('model','asc')
         ->get();
      $permissions = Permission::whereIn('model', $groups)
         ->orderBy('model')
         ->orderBy('display_name')
         ->get();
      $groups = $permissions->groupBy('model');

		return view('admin.users.create',
         compact(
            // 'modulePermissions',
            // 'moduleGroups',
            // 'corePermissions',
            // 'coreGroups',
            // 'nonCorePermissions',
            // 'nonCoreGroups',
            'user',
            'groups',
            'permissions'
         )
      );
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_delete')) { abort(401, 'Unauthorized Access'); }
      }

		$user = User::findOrFail($id);

		return view('admin.users.delete', compact('user'));
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_delete')) { abort(401, 'Unauthorized Access'); }
      }

		// Find the user to be deleted
		$user = User::find($id);
		
		// Delete the user
		$user->delete();

		// Set flash data with success message
		Session::flash('delete','The user was deleted successfully.');
		return redirect()->route('admin.users.index');
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_edit')) { abort(401, 'Unauthorized Access'); }
      }
		
		$user = User::find($id);

		// Get permissions of groups identified as module
		// $moduleGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',3)
  //        ->orderBy('model','asc')
  //        ->get();
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as core
		// $coreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',2)
  //        ->orderBy('model','asc')
  //        ->get();
		// $corePermissions = Permission::whereIn('model', $coreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $coreGroups = $corePermissions->groupBy('model');

		// // Get permissions of groups identified as NON core
		// $nonCoreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',1)
  //        ->orderBy('model','asc')
  //        ->get();
		// $nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $nonCoreGroups = $nonCorePermissions->groupBy('model');


      // Get all permissions
      $groups = Permission::select('model')
         ->distinct()
         // ->where('type',1)
         ->orderBy('model','asc')
         ->get();
      $permissions = Permission::whereIn('model', $groups)
         ->orderBy('model')
         ->orderBy('display_name')
         ->get();
      $groups = $permissions->groupBy('model');

		// Get the permissions currently assigned to this user
		$userPermissions = DB::table("permission_user")
			->where("permission_user.user_id",$id)
			->pluck('permission_user.permission_id','permission_user.permission_id')
			->all();

		return view('admin.users.edit',
         compact(
            'user',
            // 'corePermissions',
            // 'coreGroups',
            // 'modulePermissions',
            // 'moduleGroups',
            'userPermissions',
            // 'nonCorePermissions',
            // 'nonCoreGroups',
            'groups',
            'permissions'
         )
      );
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_read')) { abort(401, 'Unauthorized Access'); }
      }
		
		$user = User::find($id);

		// Get permissions of groups identified as module
		// $moduleGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',3)
  //        ->orderBy('model','asc')
  //        ->get();
		// $modulePermissions = Permission::whereIn('model', $moduleGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $moduleGroups = $modulePermissions->groupBy('model');

		// Get permissions of groups identified as core
		// $coreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',2)
  //        ->orderBy('model','asc')
  //        ->get();
		// $corePermissions = Permission::whereIn('model', $coreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $coreGroups = $corePermissions->groupBy('model');

		// // Get permissions of groups identified as NON core
		// $nonCoreGroups = Permission::select('model')
  //        ->distinct()
  //        ->where('type',1)
  //        ->orderBy('model','asc')
  //        ->get();
		// $nonCorePermissions = Permission::whereIn('model', $nonCoreGroups)
  //        ->orderBy('model')
  //        ->orderBy('display_name')
  //        ->get();
		// $nonCoreGroups = $nonCorePermissions->groupBy('model');

      // Get all permissions
      $groups = Permission::select('model')
         ->distinct()
         // ->where('type',1)
         ->orderBy('model','asc')
         ->get();
      $permissions = Permission::whereIn('model', $groups)
         ->orderBy('model')
         ->orderBy('display_name')
         ->get();
      $groups = $permissions->groupBy('model');

		// Get the permissions currently assigned to this user
		$userPermissions = DB::table("permission_user")
			->where("permission_user.user_id",$id)
			->pluck('permission_user.permission_id','permission_user.permission_id')
			->all();

		return view('admin.users.show',
			compact(
				'user',
				// 'corePermissions',
				// 'coreGroups',
				'userPermissions',
				// 'nonCorePermissions',
				// 'nonCoreGroups',
				// 'moduleGroups',
				// 'modulePermissions',
            'groups',
            'permissions'
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
      // Check if user has required permission
      if($this->enablePermissions)
      {
         if(!checkPerm('user_add')) { abort(401, 'Unauthorized Access'); }
      }

		$this->validate($request, [
			'username' => 'required',
			'email' => 'required|email|unique:users,email',
			'permission' => 'sometimes',
		]);

      $user = new User;
         $user->username         = $request->username;
         $user->email            = $request->email;
         $user->password         = $request->password;
         $user->public_email     = $request->public_email;
         $user->first_name       = $request->first_name;
         $user->last_name        = $request->last_name;
         $user->telephone        = $request->telephone;
         $user->cell             = $request->cell;
         $user->fax              = $request->fax;
         $user->website          = $request->website;
         $user->company_name     = $request->company_name;
         $user->civic_number     = $request->civic_number;
         $user->address_1        = $request->address_1;
         $user->address_2        = $request->address_2;
         $user->city             = $request->city;
         $user->province         = $request->province;
         $user->postal_code      = $request->postal_code;
         $user->notes            = $request->notes;
         $user->dart_doubleOut   = $request->dart_doubleOut;
         // $user->invoicer_client  = $request->invoicer_client;
         $user->action_buttons   = $request->action_buttons;
         $user->alert_fade_time	= $request->alert_fade_time;
         $user->author_format    = $request->author_format;
         $user->date_format      = $request->date_format;
         $user->landing_page_id  = $request->landing_page_id;
         $user->rows_per_page    = $request->rows_per_page;

         // Check if a password was provided
         if($request->password){
            $user->password = Hash::make($request->password);
         }else{
            $user->password = Hash::make('password');
         }

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
         };

      $user->save();

		$user->permissions()->attach($request->input('permission'));

		return redirect()->route('admin.users.index')->with('success','User created successfully');
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
      if($this->enablePermissions)
      {
         if(!checkPerm('user_edit')) { abort(401, 'Unauthorized Access'); }
      }

		$user = User::findOrFail($id);
      // dd($user);

		$this->validate($request, [
			'username' => 'required',
			'email' => 'required|email|unique:users,email,'.$user->id,
			'permission' => 'sometimes',
		]);

			$user->username = $request->input('username');
			$user->email = $request->input('email');
         $user->public_email = $request->input('public_email');
         // $user->invoicer_client = $request->input('invoicer_client');
         $user->first_name = $request->input('first_name');
         $user->last_name = $request->input('last_name');
         $user->telephone = $request->input('telephone');
         $user->cell = $request->input('cell');
         $user->fax = $request->input('fax');
         $user->website = $request->input('website');
         $user->company_name = $request->input('company_name');
         $user->civic_number = $request->input('civic_number');
         $user->address_1 = $request->input('address_1');
         $user->address_2 = $request->input('address_2');
         $user->city = $request->input('city');
         $user->province = $request->input('province');
         $user->postal_code = $request->input('postal_code');
         $user->notes = $request->input('notes');
         $user->dart_doubleOut = $request->input('dart_doubleOut');
         // $user->action_buttons = $request->input('action_buttons');
         // $user->alert_fade_time = $request->input('alert_fade_time');
         // $user->author_format = $request->input('author_format');
         // $user->date_format = $request->input('date_format');
         // $user->landing_page_id = $request->input('landing_page_id');
         // $user->rows_per_page = $request->input('rows_per_page');

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

		$user->permissions()->sync($request->input('permission'));

		if($request->submit == "close")
		{
			return redirect()->route('admin.users.index')->with('success','User updated successfully');
		} else {
			return redirect()->route('admin.users.edit', $user->id)->with('success','User updated successfully');
		}
	}


}
