<?php

// Check if logged in user has specified permission or if they are the author of the model
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
         // Return TRUE if the logged in user has the specified access permission
         if($perm->name == $pname)
         {
            return true;
         }
      }

      if($model)
      {
        // echo($model);
         // Return TRUE if the logged in user is the owner of the current model
         if($model->user_id == auth::user()->id)
         {
            // echo $model->user_id;
            // echo auth::user()->id;
            return true;
         }
      }
   }
   return false;
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