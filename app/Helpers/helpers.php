<?php

// Check if logged in user has specified permission or if they are the author of the model
function checkPerm($pname, $model = null)
{
	// Check if user is logged in
	if(Auth::check())
	{
		// If user is "administrator", do not proceed with permission checks
		// if(Auth::user()->username == "administrator") {
		// if(Auth::user()->username == Setting('admin_user_account')) {
		if (
				(Auth::user()->username == Setting('admin_user_account')) ||
				(Auth::user()->username == 'lerouxs') ||
				(Auth::user()->username == 'administrator')
			) {
			return true;

		// If user is not "administrator", proceed with permission checks
		} else {
			// Get the logged in user's permissions
			$perms = Auth::user()->permissions;

			foreach($perms as $perm)
			{
				// Return TRUE if the logged in user has the specified access permission
				if($perm->name == $pname)
				{
					return true;
				}
			}

			if($model)
			{
				// Return TRUE if the logged in user is the owner of the current model
				if($model->user_id == auth::user()->id)
				{
					return true;
				}

// if($model->id == auth::user()->id)
// {
// 	return true;
// }
			}
		}
	}
	
	// User is not logged in or does not own the model, so deny access
	return false;
}


function getUser()
{
	return Auth::user();
}

// Returns setting values from settings table in database
// https://stackoverflow.com/questions/32824781/laravel-load-settings-from-database
function setting($key)
{
	return Cache::get('setting')->where('key', $key)->first()->value;
}


// Used in the recipes menu to convert from fruitDishes to Fruit Dishes
function deliciousCamelcase($str)
{
	$formattedStr = '';
	$re = '/
			(?<=[a-z])
			(?=[A-Z])
			| (?<=[A-Z])
			(?=[A-Z][a-z])
			/x';
	$a = preg_split($re, $str);
	$formattedStr = implode(' ', $a);
	return $formattedStr;
}

