<?php

// Used in the backend to allow Admin to reset a user's password

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
      $this->enablePermissions = true;
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
      return view('admin.users.changePassword', compact('user'));
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

      return redirect()->route('admin.users.index')->with('success','User\'s password updated successfully');
   }


}
