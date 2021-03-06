<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Auth;
use Session;
use App\Category;
use App\Profile;
use App\User;
use Image;
use File;

use App\Http\Requests\UpdateProfileAccountRequest;

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
	 }


##################################################################################################################
#  ██████╗██╗  ██╗ █████╗ ███╗   ██╗ ██████╗ ███████╗    ██████╗ ██╗    ██╗██████╗ 
# ██╔════╝██║  ██║██╔══██╗████╗  ██║██╔════╝ ██╔════╝    ██╔══██╗██║    ██║██╔══██╗
# ██║     ███████║███████║██╔██╗ ██║██║  ███╗█████╗      ██████╔╝██║ █╗ ██║██║  ██║
# ██║     ██╔══██║██╔══██║██║╚██╗██║██║   ██║██╔══╝      ██╔═══╝ ██║███╗██║██║  ██║
# ╚██████╗██║  ██║██║  ██║██║ ╚████║╚██████╔╝███████╗    ██║     ╚███╔███╔╝██████╔╝
#  ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝    ╚═╝      ╚══╝╚══╝ ╚═════╝ 
##################################################################################################################
	public function resetPwd($id)
	{
		// return redirect()->route('profile', $id)->withInput(['tab'=>'changePwd']);
		$user = User::findOrFail($id);
		return view('profiles.resetPwd', compact('user'));
	}

	public function resetPwdPost(Request $request)
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
		
		// return redirect()->back()->with("success","Password changed successfully!");
		Session::flash ('success', 'Password changed successfully!');
		return redirect()->route('profile.index', $user->id);
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
		$profile = Profile::find($id);

		// Delete the image from the system
		File::delete('_profiles/' . $profile->image);
		
		// Update database
		$profile->image = NULL;
		$profile->save();

		// Set flash data with success message and return user to same tab
		Session::flash ('success', 'Your profile image was successfully removed!');
		return redirect()->route('profile', $id)->withInput(['tab'=>'profile']);
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
	 public function index($id)
	 {
		// Find the logged in user
		$user = User::with('profile')->findOrFail(Auth::user()->id);
		//dd($user);

		// find all projects categories in the categories table and pass them to the view
		// if(checkACL('manager')) {
		// 	$landingpages = Category::whereHas('module', function ($query) {
		// 		$query
		// 			->where('name', '=', 'landing pages');
		// 	})->orderBy('name','asc')->get();
		// } else {
			$landingpages = Category::whereHas('module', function ($query) {
				$query
					->where('name', '=', 'landing pages')
					//->where('value', 'NOT LIKE', '%(BE)%')
				;
			})->orderBy('name','asc')->get();
		// }

		// Create an empty array to store the categories
		$landingPages = [];

		// Store the category values into the $cats array
		foreach ($landingpages as $landingPage) {
			$landingPages[$landingPage->id] = ucfirst($landingPage->value);
		}

		return view('profiles.index', compact('user'))->withLandingPages($landingPages);
	}


##################################################################################################################
# ██████╗ ███████╗███████╗███████╗████████╗    ███████╗███████╗████████╗████████╗██╗███╗   ██╗ ██████╗ ███████╗
# ██╔══██╗██╔════╝██╔════╝██╔════╝╚══██╔══╝    ██╔════╝██╔════╝╚══██╔══╝╚══██╔══╝██║████╗  ██║██╔════╝ ██╔════╝
# ██████╔╝█████╗  ███████╗█████╗     ██║       ███████╗█████╗     ██║      ██║   ██║██╔██╗ ██║██║  ███╗███████╗
# ██╔══██╗██╔══╝  ╚════██║██╔══╝     ██║       ╚════██║██╔══╝     ██║      ██║   ██║██║╚██╗██║██║   ██║╚════██║
# ██║  ██║███████╗███████║███████╗   ██║       ███████║███████╗   ██║      ██║   ██║██║ ╚████║╚██████╔╝███████║
# ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝       ╚══════╝╚══════╝   ╚═╝      ╚═╝   ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝
##################################################################################################################
	// public function resetSettings(Request $request, $id)
	// {
	// 	$profile = Profile::findOrFail($id);
	// 		 $profile->frontendStyle = 'slate';
	// 		 $profile->backendStyle = 'bootstrap';
	// 		 $profile->author_format = 1;
	// 		 $profile->alert_fade_time = 5000;
	// 		 $profile->date_format = 1;
	// 		 $profile->landing_page = 'home';
	// 		 $profile->rows_per_page = 15;
	// 		 $profile->display_size = 'normal';
	// 		 $profile->action_buttons = 1;
	// 		 $profile->layout = 1;
	// 	$profile->save();
		
	// 	// Save entry to log file using built-in Monolog
	// 	//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
	// 	//    [json_decode($article, true)]
	// 	//);

	// 	Session::flash('success','Your preferences have been reset to their default values successfully.');
	// 	return redirect()->route('profile', $id)->withInput(['tab'=>'settings']);
	//  }
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
		//dd($id);
		$profile = Profile::findOrFail($id);
		//dd($profile);
			$profile->frontendStyle = 'slate';
			$profile->backendStyle = 'bootstrap';
			$profile->author_format = 1;
			$profile->alert_fade_time = 5000;
			$profile->date_format = 1;
			$profile->landing_page_id = 41;
			$profile->rows_per_page = 15;
			$profile->display_size = 'normal';
			$profile->action_buttons = 1;
			$profile->layout = 1;
		$profile->save();
		
		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
		//    [json_decode($article, true)]
		//);

		Session::flash('success','Your preferences have been reset to their default values successfully.');
		// return redirect()->route('profile', $id)->withInput(['tab'=>'settings']);
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
			$user = User::findOrFail($id);
			//dd($user);
			return view('profiles.index', compact('user'));
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
	public function profile($id)
	{
		$user = User::with('profile')->findOrFail($id);
		// dd($user);
		return view('profiles.profile', compact('user'));
	}

	 public function profilePost(UpdateProfileProfileRequest $request, $id)
	 {

		$profile = Profile::findOrFail($id);

			$profile->first_name = $request->first_name;
			$profile->last_name = $request->last_name;
			$profile->telephone = $request->telephone;
			//$profile->image = $request->image;

			// Check if a new image was submitted
			if ($request->hasFile('image')) {
				//Add new photo
				$image = $request->file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				//dd($filename);
				$location = public_path('_profiles/' . $filename);
				Image::make($image)->resize(800, 400)->save($location);
					
				// get name of old image
				$oldImageName = $profile->image;
					
				// Update database
				$profile->image = $filename;

				// Delete old photo
				//Storage::delete($oldImageName);
				File::delete('_profiles/' . $oldImageName);
			 }

		$profile->save();
		
		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
		//    [json_decode($article, true)]
		//);

		Session::flash('success','Your profile has been updated successfully.');
		return redirect()->route('profiles.index', $profile->id);
	 }


##################################################################################################################
# ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗     █████╗  ██████╗ ██████╗████████╗
# ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝╚══██╔══╝
# ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗      ███████║██║     ██║        ██║   
# ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝      ██╔══██║██║     ██║        ██║   
# ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗    ██║  ██║╚██████╗╚██████╗   ██║   
#  ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝ ╚═════╝ ╚═════╝   ╚═╝   
##################################################################################################################
	public function account($id)
	{
		// return redirect()->route('profile', $id)->withInput(['tab'=>'account']);
		$user = User::findOrFail($id);
		return view('profiles.account', compact('user'));
	}

	public function accountPost(UpdateProfileAccountRequest $request, $id)
	{
		// $rules = [
		// 	'email' => 'required|unique:users,email,'.$id,
		// ];

		// $customMessages = [
		// 	'email.required' => 'The :attribute field is required.',
		// 	'email.unique' => 'The :attribute field must be unique.'
		// ];

		// $this->validate($request, $rules, $customMessages);

		$user = User::findOrFail($id);
		//dd($user);
			 $user->email = $request->email;
			 $user->public_email = $request->public_email;
		$user->save();
		
		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
		//    [json_decode($article, true)]
		//);

		Session::flash('success','Your account has been updated successfully.');
		return redirect()->route('profile.index', $id);
	 }

##################################################################################################################
# ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗    ███████╗███████╗████████╗████████╗██╗███╗   ██╗ ██████╗ ███████╗
# ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝    ██╔════╝██╔════╝╚══██╔══╝╚══██╔══╝██║████╗  ██║██╔════╝ ██╔════╝
# ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗      ███████╗█████╗     ██║      ██║   ██║██╔██╗ ██║██║  ███╗███████╗
# ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝      ╚════██║██╔══╝     ██║      ██║   ██║██║╚██╗██║██║   ██║╚════██║
# ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗    ███████║███████╗   ██║      ██║   ██║██║ ╚████║╚██████╔╝███████║
#  ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚══════╝╚══════╝   ╚═╝      ╚═╝   ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚══════╝
##################################################################################################################
	public function preferences($id)
	{
		// return redirect()->route('profile', $id)->withInput(['tab'=>'settings']);
		// find all projects categories in the categories table and pass them to the view
		// if(checkACL('manager')) {
			$landingpages = Category::whereHas('module', function ($query) {
				$query
					->where('name', '=', 'landing pages');
			})->orderBy('name','asc')->get();
		// } else {
		// 	$landingpages = Category::whereHas('module', function ($query) {
		// 		$query
		// 			->where('name', '=', 'landing pages')
		// 			//->where('value', 'NOT LIKE', '%(BE)%')
		// 		;
		// 	})->orderBy('name','asc')->get();
		// }

		// Create an empty array to store the categories
		$landingPages = [];

		// Store the category values into the $cats array
		foreach ($landingpages as $landingPage) {
			$landingPages[$landingPage->id] = ucfirst($landingPage->value);
		}

		$user = User::findOrFail($id);
		return view('profiles.preferences', compact('user','landingPages'));
	}

	public function preferencesPost(Request $request, $id)
	{
		$profile = Profile::findOrFail($id);
			 $profile->frontendStyle = $request->frontendStyle;
			 $profile->backendStyle = $request->backendStyle;
			 $profile->author_format = $request->author_format;
			 $profile->alert_fade_time = $request->alert_fade_time;
			 $profile->date_format = $request->date_format;
			 $profile->landing_page_id = $request->landing_page_id;
			 $profile->rows_per_page = $request->rows_per_page;
			 $profile->display_size = $request->display_size;
			 $profile->action_buttons = $request->action_buttons;
			 $profile->layout = $request->layout;
		$profile->save();
		
		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
		//    [json_decode($article, true)]
		//);

		Session::flash('success','Your preferences have been updated successfully.');
		// return redirect()->route('profile', $id)->withInput(['tab'=>'settings']);
		return redirect()->back();

	 }

















	public function edit(Request $request, $id)
	{
		$landingpages = Category::whereHas('module', function ($query) {
			$query->where('name', '=', 'landing pages');
		})->orderBy('name','asc')->get();

		// Create an empty array to store the landing pages
		$landingPages = [];

		// Store the landing pages values into the $landingPages array
		foreach ($landingpages as $landingPage) {
			$landingPages[$landingPage->id] = ucfirst($landingPage->value);
		}

		$user = User::with('profile')->findOrFail($id);

		return view('profiles.edit', compact('user', 'landingPages'));
	}


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
		
		$user = User::with('profile')->findOrFail($id);
			$user->email = $request->input('email');
			$user->public_email = $request->input('public_email');
			$user->profile->first_name = $request->input('first_name');
			$user->profile->last_name = $request->input('last_name');
			$user->profile->telephone = $request->input('telephone');
			$user->profile->civic_number = $request->input('civic_number');
			$user->profile->address1 = $request->input('address1');
			$user->profile->address2 = $request->input('address2');
			$user->profile->city = $request->input('city');
			$user->profile->province = $request->input('province');
			$user->profile->postal_code = $request->input('postal_code');
			$user->profile->action_buttons = $request->input('action_buttons');
			$user->profile->alert_fade_time = $request->input('alert_fade_time');
			$user->profile->author_format = $request->input('author_format');
			$user->profile->date_format = $request->input('date_format');
			$user->profile->landing_page_id = $request->input('landing_page_id');
			$user->profile->rows_per_page = $request->input('rows_per_page');
			// $user->profile->display_size = $request->input('display_size');
		$user->save();
		$user->profile->save();

		Session::flash('success','Your profile has been updated.');
		return redirect()->back();
	}





}
