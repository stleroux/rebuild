<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
// use App\Http\Controllers\Controller;
use App\Module;

use Illuminate\Support\Facades\Input;

use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreateModuleRequest;
use App\Http\Requests\UpdateModuleRequest;

class ModulesController extends Controller
{

##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################
	public function __construct() {
		// only allow authenticated users to access these pages
		$this->middleware('auth');

		//Log::useFiles(storage_path().'/logs/Admin_Modules.log');
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
	public function delete($id)
	{
		// Check if user has required module
		if(!checkPerm('module_delete')) { abort(401, 'Unauthorized Access'); }

		$module = Module::findOrFail($id);
		return view('modules.delete', compact('module'));
	}


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
	public function destroy($id)
	{
		// Check if user has required module
		if(!checkPerm('module_delete')) { abort(401, 'Unauthorized Access'); }

		$module = Module::find($id);

		// $categories = Category::where('module_id', '=', $id);
		// dd($categories);

		$module->delete();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED module (" . $module->id . ")\r\n", [json_decode($module, true)]);

		Session::flash('delete', 'The module was successfully deleted!');
		return redirect()->route('modules.index');
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
		// Check if user has required permission
		if(!checkPerm('module_edit')) { abort(401, 'Unauthorized Access'); }

		$module = Module::find($id);
		return  view('modules.edit', compact('module'));
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
		// Check if user has required permission
		if(!checkPerm('module_index')) { abort(401, 'Unauthorized Access'); }

		$modules = Module::orderBy('name','ASC')->get();
		return view('modules.index',compact('modules'));
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
	public function store(CreateModuleRequest $request)
	{
		// Check if user has required permission
		if(!checkPerm('module_create')) { abort(401, 'Unauthorized Access'); }

		$module = new Module;
			$module->name = $request->name;
		$module->save();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED module (" . $module->id . ")\r\n", [json_decode($module, true)]);

		Session::flash('store','The new module has been created.');
		return redirect()->route('modules.index');
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
	public function update(UpdateModuleRequest $request, $id)
	{
		// Get the category value from the database
		$module = Module::find($id);
			$module->name = $request->input('name');
		$module->save();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED module (" . $module->id . ")\r\n", [json_decode($module, true)]);

		// Set flash data with success message
		Session::flash ('update', 'The module was successfully updated!');
		// Redirect to posts.show
		return redirect()->route('modules.index');
	}














##################################################################################################################
# ███████╗██╗  ██╗██████╗  ██████╗ ██████╗ ████████╗    ██████╗ ██████╗ ███████╗
# ██╔════╝╚██╗██╔╝██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝    ██╔══██╗██╔══██╗██╔════╝
# █████╗   ╚███╔╝ ██████╔╝██║   ██║██████╔╝   ██║       ██████╔╝██║  ██║█████╗  
# ██╔══╝   ██╔██╗ ██╔═══╝ ██║   ██║██╔══██╗   ██║       ██╔═══╝ ██║  ██║██╔══╝  
# ███████╗██╔╝ ██╗██║     ╚██████╔╝██║  ██║   ██║       ██║     ██████╔╝██║     
# ╚══════╝╚═╝  ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═════╝ ╚═╝     
##################################################################################################################
	public function exportPDF()
	{
		if(!checkACL('manager')) {
			return view('errors.403');
		}

		$data = Module::get()->toArray();
		return Excel::create('Modules_List', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
			{
				$sheet->fromArray($data);
			});
		})->download("pdf");
	}


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║   
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║   
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║   
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝   
// IMPORT :: Show the form for importing entries to storage.
##################################################################################################################
	public function import()
	{
		if(!checkACL('manager')) {
			return view('errors.403');
		}

		return view('backend.modules.import');
	}


##################################################################################################################
# ██████╗  ██████╗ ██╗    ██╗███╗   ██╗██╗      ██████╗  █████╗ ██████╗     ███████╗██╗  ██╗ ██████╗███████╗██╗     
# ██╔══██╗██╔═══██╗██║    ██║████╗  ██║██║     ██╔═══██╗██╔══██╗██╔══██╗    ██╔════╝╚██╗██╔╝██╔════╝██╔════╝██║     
# ██║  ██║██║   ██║██║ █╗ ██║██╔██╗ ██║██║     ██║   ██║███████║██║  ██║    █████╗   ╚███╔╝ ██║     █████╗  ██║     
# ██║  ██║██║   ██║██║███╗██║██║╚██╗██║██║     ██║   ██║██╔══██║██║  ██║    ██╔══╝   ██╔██╗ ██║     ██╔══╝  ██║     
# ██████╔╝╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗╚██████╔╝██║  ██║██████╔╝    ███████╗██╔╝ ██╗╚██████╗███████╗███████╗
# ╚═════╝  ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═════╝     ╚══════╝╚═╝  ╚═╝ ╚═════╝╚══════╝╚══════╝
##################################################################################################################
	public function downloadExcel($type)
	{
		if(!checkACL('manager')) {
			return view('errors.403');
		}

		$data = Module::get()->toArray();
		return Excel::create('Modules_List', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
			{
				$sheet->fromArray($data);
			});
		})->download($type);
	}


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗    ███████╗██╗   ██╗███╗   ██╗ ██████╗████████╗██╗ ██████╗ ███╗   ██╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝    ██╔════╝██║   ██║████╗  ██║██╔════╝╚══██╔══╝██║██╔═══██╗████╗  ██║
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║       █████╗  ██║   ██║██╔██╗ ██║██║        ██║   ██║██║   ██║██╔██╗ ██║
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║       ██╔══╝  ██║   ██║██║╚██╗██║██║        ██║   ██║██║   ██║██║╚██╗██║
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║       ██║     ╚██████╔╝██║ ╚████║╚██████╗   ██║   ██║╚██████╔╝██║ ╚████║
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝       ╚═╝      ╚═════╝ ╚═╝  ╚═══╝ ╚═════╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝
##################################################################################################################
	public function importExcel()
	{
		if(!checkACL('manager')) {
			return view('errors.403');
		}

		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {})->get();
			
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'name'         => $value->name,
						'created_at'    => $value->created_at,
						'updated_at'    => $value->updated_at,
					];
				}
							
				if(!empty($insert)){
					DB::table('modules')->insert($insert);
					//dd('Insert Record successfully.');
					Session::flash('success','Import was successfull!');
					//return view('roles.index');
					return redirect()->route('backend.modules.index');
				}
			}
		}
		return back();
	}


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗    ███╗   ███╗ ██████╗ ██████╗ ██╗   ██╗██╗     ███████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ████╗ ████║██╔═══██╗██╔══██╗██║   ██║██║     ██╔════╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██╔████╔██║██║   ██║██║  ██║██║   ██║██║     █████╗  ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██║╚██╔╝██║██║   ██║██║  ██║██║   ██║██║     ██╔══╝  ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ██║ ╚═╝ ██║╚██████╔╝██████╔╝╚██████╔╝███████╗███████╗███████║
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝     ╚═╝     ╚═╝ ╚═════╝ ╚═════╝  ╚═════╝ ╚══════╝╚══════╝╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
	 public function newModules(Request $request, $key=null)
	 {
			// if(!checkACL('guest')) {
			//     return view('errors.403');
			// }

			//$alphas = range('A', 'Z');
			$alphas = DB::table('modules')
				 ->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
				 ->where('created_at', '>=' , Auth::user()->last_login_date)
				 //->where('user_id', '=', Auth::user()->id)
				 // ->where('personal', '!=', 1)
				 // ->where('published_at','!=', null)
				 ->orderBy('letter')
				 ->get();
			//dd($alphas);

			$letters = [];
			foreach($alphas as $alpha) {
				$letters[] = $alpha->letter;
			}

			// If $key value is passed
			if ($key) {
				$modules = Module::newModules()
					->where('namee', 'like', $key . '%')
					->get();
			} else {
				$modules = Module::newModules()->get();
			}

			return view('backend.modules.newModules', compact('modules','letters'));
	 }

	 
 }