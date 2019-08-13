<?php

// Used in the backend to allow Admin to reset a user's password

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
use Illuminate\Http\Request;


class ChangePasswordController extends Controller
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
#  ██████╗██╗  ██╗ █████╗ ███╗   ██╗ ██████╗ ███████╗    ██████╗ ██╗    ██╗██████╗ 
# ██╔════╝██║  ██║██╔══██╗████╗  ██║██╔════╝ ██╔════╝    ██╔══██╗██║    ██║██╔══██╗
# ██║     ███████║███████║██╔██╗ ██║██║  ███╗█████╗      ██████╔╝██║ █╗ ██║██║  ██║
# ██║     ██╔══██║██╔══██║██║╚██╗██║██║   ██║██╔══╝      ██╔═══╝ ██║███╗██║██║  ██║
# ╚██████╗██║  ██║██║  ██║██║ ╚████║╚██████╔╝███████╗    ██║     ╚███╔███╔╝██████╔╝
#  ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝    ╚═╝      ╚══╝╚══╝ ╚═════╝
##################################################################################################################
   public function edit($id)
   {
      if($this->enablePermissions)
      {
         if(!checkPerm('change_user_pwd')) { abort(401, 'Unauthorized Access'); }
      }

      $user = User::findOrFail($id);
      return view('users.changePassword', compact('user'));
   }


##################################################################################################################
##################################################################################################################
# Change User PWD Post
##################################################################################################################
##################################################################################################################
   public function update(Request $request, $id)
   {
      // Allows an admin to change user account passwords

      if($this->enablePermissions)
      {
         if(!checkPerm('change_user_pwd')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'password' => 'required|confirmed|min:6',
      ]);

      $user = User::findOrFail($id);
         $user->password = Hash::make($request->password);
      $user->save();

      return redirect()->route('users.index')->with('success','User\'s password updated successfully');
   }





}
