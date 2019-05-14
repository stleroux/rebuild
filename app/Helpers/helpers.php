<?php

// Check if logged in user has specified permission
function checkPerm($pname, $model = null)
{
   if(Auth::check())
   {
      // if(in_array(auth()->user()->id, [1,2]))
      // {
      //    return true;
      // }

      // Get the logged in user's permissions
      $perms = Auth::user()->permissions;

      foreach($perms as $perm)
      {
         // Check if logged in user has specified permission
         // print_r($perm);
         if($perm->name == $pname)
         {
            // User has permission
            return true;
         }
      }
   }

   // if($model)
   // {
   //    // Check if logged in user is the owner of the record
   //    if($model->user_id == auth::user()->id)
   //    {
   //       // User is the record owner
   //       return true;
   //    }
   // }

   // if(Auth::check()) {
   //    if(in_array(auth()->user()->id, [1,2]))
   //    {
   //       return true;
   //    }
   // }

}


function getUser(){
    return Auth::user();
}

// Returns setting values from settings table in database
// https://stackoverflow.com/questions/32824781/laravel-load-settings-from-database
function setting($key)
{
    return Cache::get('setting')->where('key', $key)->first()->value;
}