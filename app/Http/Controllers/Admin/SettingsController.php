<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;
use Flash;
use Session;


class SettingsController extends Controller
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
        // Only allow authenticated users access to these functions
        $this->middleware('auth');
        $this->enablePermissions = false;

        //Log::useFiles(storage_path().'/logs/audits.log');
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
        // if(!checkPerm('module_create')) { abort(401, 'Unauthorized Access'); }

        return view('settings.create');
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
        $invoicer = Setting::where('tab','=','invoicer')->get();
        $site = Setting::where('tab','=','site')->get();
        $settings = Setting::where('tab','=','general')->get();

        return view('settings.index', compact('invoicer','site','settings'));
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
        $rules = [
            'key' => 'required',
            'value' => 'required',
            'tab' => 'required',
            'description' => 'required',
        ];

        $customMessages = [
            'key.required' => 'The :attribute field can not be left blank.',
            'value.required' => 'The :attribute field is required.',
            'tab.required' => 'The :attribute field is required.',
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
        $setting = Setting::findOrFail($id);
        return view('settings.edit', compact('setting'));
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

        Session::flash('update', 'The setting has been updated successfully.');
        return redirect()->route('settings.index');
    }


##################################################################################################################
# ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗     █████╗ ██╗     ██╗     
# ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██║     ██║     
# ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗      ███████║██║     ██║     
# ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝      ██╔══██║██║     ██║     
# ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗    ██║  ██║███████╗███████╗
#  ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// UPDATE :: Update the specified resource in storage
##################################################################################################################
    public function updateAll(Request $request)
    {
        // // validate the data
        // $this->validate($request, array(
        //     'key' => 'required',
        //     'value' => 'required',
        //     'description' => 'required',
        // ));

        // $setting = Setting::findOrFail($id);
        //     $setting->key = $request->key;
        //     $setting->value = $request->value;
        //     $setting->tab = $request->tab;
        //     $setting->description = $request->description;
        // $setting->save();

        // Session::flash('update', 'The site settings have been updated successfully.');
        // return redirect()->route('settings.index');
        $rows = $request->input('id');
        
        $values = $request->input('value');

        for($i=0; $i<count($rows); $i++) {
              Setting::where('id', $rows[$i])->update(['value'=>$values[$i]]);
           }

        Session::flash('update', 'The site settings have been updated successfully.');
        return redirect()->route('settings.index');

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
    // public function delete(Setting $setting)
    // {
    //     // Check if user has required permission
    //     // if(!checkPerm('setting_delete')) { abort(401, 'Unauthorized Access'); }

    //     $setting = Setting::findOrFail($setting->id);
    //     return view('settings.delete', compact('setting'));
    // }


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
    // public function destroy($id)
    // {
    //     // Check if user has required permission
    //     //if(!checkPerm('permission_delete')) { abort(401, 'Unauthorized Access'); }

    //     $setting = Setting::findOrFail($id);
    //     $setting->delete();

    //     // Set flash data with success message
    //     Session::flash('delete','The site setting was deleted successfully.');
    //     // Redirect
    //     return redirect()->route('settings.index');
    // }


    // public function updatePlus(Request $request)
    // {
    //     $rows = $request->input('id');
    //     $values = $request->input('value');

    //     for($i=0; $i<count($rows); $i++) {
    //           Setting::where('id', $rows[$i])->update(['value'=>$values[$i]]);
    //        }

    //     Session::flash('update', 'The site settings have been updated successfully.');
    //     return redirect()->route('settings.index');
    // }


}
