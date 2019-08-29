<?php

// Used in the frontend for user's to reset their own password

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Auth;
use Session;
use App\Models\User;

class ResetPasswordController extends Controller
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
      $user = User::findOrFail($id);
      return view('users.profile.resetPassword', compact('user'));
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
   public function update(Request $request)
   {
      // The current password does not match the one provided
      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
         Session::flash ('danger', 'Your current password does not match the password you provided. Please try again.');
         return redirect()->back();
      }

      // Current password and new password are the same
      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
         Session::flash ('danger', 'The new password cannot be the same as your current password. Please choose a different password.');
         return redirect()->back();
      }

      // The new apssword field is blank
      if($request->get('new-password') == "")
      {
         Session::flash ('danger', 'The new password cannot be blank.');
         return redirect()->back();
      }

      // Current password and new password are the same
      if($request->get('new-password') != $request->get('new-password_confirmation'))
      {
         Session::flash ('danger', 'The new passwords do not match.');
         return redirect()->back();
      }

      //Change Password
      $user = Auth::user();
          $user->password = bcrypt($request->get('new-password'));
      $user->save();
      
      Session::flash ('success', 'Password changed successfully!');
      return redirect()->route('profile.show', $user->id);
   }


}
