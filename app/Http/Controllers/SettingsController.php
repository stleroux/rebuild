<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use DB;
use Flash;
use Session;


class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::where('tab','=', 'general')->get();
        $profiles = Setting::where('tab','=', 'profile')->get();

        return view('settings.index', compact('settings', 'profiles'));
    }


    public function store(Request $request)
    {
        $rules = [
            'key' => 'required',
            'value' => 'required',
            'tab' => 'required',
            'description' => 'required',
        ];

        $customMessages = [
            'key.required' => 'The :attribute field can not be left blank.',
            'value.required' => 'The :attribute field is required.',
            'description.required' => 'The :attribute field is required.',
        ];

        $this->validate($request, $rules, $customMessages);

        // save the data in the database
        $setting = new Setting;
            $setting->key = $request->key;
            $setting->value = $request->value;
            $setting->tab = $request->tab;
            $setting->description = $request->description;
        $setting->save();

        // set a flash message to be displayed on screen
        Session::flash('store','The setting was successfully saved!');

        if($request->submit == "new")
        {
            return redirect()->route('settings.create');
        } else {
            // redirect to another page
            return redirect()->route('settings.index');
        }
    }


    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('settings.edit', compact('setting'));
    }


    public function update(Request $request, $id)
    {
        // validate the data
        $this->validate($request, array(
            'key' => 'required',
            'value' => 'required',
            'description' => 'required',
        ));

        $setting = Setting::findOrFail($id);
            $setting->key = $request->key;
            $setting->value = $request->value;
            $setting->tab = $request->tab;
            $setting->description = $request->description;
        $setting->save();

        Session::flash('update', 'The site settings have been updated successfully.');
        return redirect()->route('settings.index');

    }


    public function destroy($id)
    {
        // Check if user has required permission
        //if(!checkPerm('permission_delete')) { abort(401, 'Unauthorized Access'); }

        $setting = Setting::findOrFail($id);
        $setting->delete();

        // Set flash data with success message
        Session::flash('delete','The site setting was deleted successfully.');
        // Redirect
        return redirect()->route('settings.index');
    }


    // public function settingsPlus()
    // {
    //     $settings = Setting::where('tab','=', 'general')->get();
    //     $profiles = Setting::where('tab','=', 'profile')->get();
    //     // dd($settings);
    //     return view('settings.settingsPlus', compact('settings', 'profiles'));
    // }

    public function updatePlus(Request $request)
    {
        $rows = $request->input('id');
        $values = $request->input('value');

        for($i=0; $i<count($rows); $i++) {
              Setting::where('id', $rows[$i])->update(['value'=>$values[$i]]);
           }

        Session::flash('update', 'The site settings have been updated successfully.');
        return redirect()->route('settings.index');
    }


}
