<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use Hash;
use Auth;
use Session;
// use App\Models\Category;
// use App\Models\Profile;
use App\Models\User;
use Image;
use File;

// use App\Http\Requests\UpdateProfileAccountRequest;

class ProfileController extends Controller
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
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ██╗███╗   ███╗ █████╗  ██████╗ ███████╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██║████╗ ████║██╔══██╗██╔════╝ ██╔════╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ██║██╔████╔██║███████║██║  ███╗█████╗  
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██║██║╚██╔╝██║██╔══██║██║   ██║██╔══╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██║██║ ╚═╝ ██║██║  ██║╚██████╔╝███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝
##################################################################################################################
   public function deleteImage($id)
   {
      // Find the user
      $user = User::find($id);

      // Delete the image from the system
      File::delete('_profiles/' . $user->image);
      
      // Update database
      $user->image = NULL;
      $user->save();

      // Set flash data with success message and return user to same tab
      Session::flash ('success', 'Your profile image was successfully removed!');
      return redirect()->route('profile.show', $id);
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
   public function edit(Request $request, $id)
   {
      $user = User::findOrFail($id);
      // dd($user);

      if($this->enablePermissions)
      {
         if(!checkPerm('profile_edit', $user)) { abort(401, 'Unauthorized Access'); }
      }

      // $user = User::with('profile')->findOrFail($id);
      

      return view('users.profile.edit', compact('user'));
   }


##################################################################################################################
# ██████╗ ███████╗███████╗███████╗████████╗    ███████╗███████╗████████╗████████╗██╗███╗   ██╗ ██████╗ ███████╗
# ██╔══██╗██╔════╝██╔════╝██╔════╝╚══██╔══╝    ██╔════╝██╔════╝╚══██╔══╝╚══██╔══╝██║████╗  ██║██╔════╝ ██╔════╝
# ██████╔╝█████╗  ███████╗█████╗     ██║       ███████╗█████╗     ██║      ██║   ██║██╔██╗ ██║██║  ███╗███████╗
# ██╔══██╗██╔══╝  ╚════██║██╔══╝     ██║       ╚════██║██╔══╝     ██║      ██║   ██║██║╚██╗██║██║   ██║╚════██║
# ██║  ██║███████╗███████║███████╗   ██║       ███████║███████╗   ██║      ██║   ██║██║ ╚████║╚██████╔╝███████║
# ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝       ╚══════╝╚══════╝   ╚═╝      ╚═╝   ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝
##################################################################################################################
   public function resetPreferences(Request $request, $id)
   {
      $user = User::findOrFail($id);
         $user->frontendStyle = 'slate';
         $user->backendStyle = 'bootstrap';
         $user->author_format = 1;
         $user->alert_fade_time = 5000;
         $user->date_format = 1;
         $user->landing_page_id = 41;
         $user->rows_per_page = 15;
         $user->display_size = 'normal';
         $user->action_buttons = 1;
         $user->layout = 1;
      $user->save();
      
      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
      //    [json_decode($article, true)]
      //);

      Session::flash('success','Your preferences have been reset to their default values successfully.');
      return redirect()->back();
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
      // Find the user
      $user = User::findOrFail($id);
      // dd($user);

      if($this->enablePermissions)
      {
         if(!checkPerm('profile_show', $user)) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      return view('users.profile.show', compact('user')); // ->withLandingPages($landingPages);
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
      $rules = [
         'email' => 'required|email|unique:users,email,'.$id,
         'first_name' => 'required|min:2',
         'last_name' => 'required|min:2',
      ];

      $customMessages = [
         'email.required' => 'The :attribute field can not be left blank.',
         'email.unique' => 'This :attribute address is already taken.',
         'email.email' => 'The email address is not valid.',
         'first_name.required' => 'The first name field can not be left blank.',
         'first_name.min' => 'The first name field must be at least 2 characters long.',
         'last_name.min' => 'The last name field must be at least 2 characters long.',
      ];

      $this->validate($request, $rules, $customMessages);
      
      $user = User::findOrFail($id);
         $user->username = $request->input('username');
         $user->invoicer_client = $request->input('invocier_client');         

         $user->first_name = $request->input('first_name');
         $user->last_name = $request->input('last_name');
         $user->email = $request->input('email');
         $user->public_email = $request->input('public_email');
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

      $user->permissions()->sync($request->input('permission'));

      Session::flash('success','Your profile has been updated.');
      // return redirect()->back();
      return view('users.profile.show', compact('user'));
   }


}
