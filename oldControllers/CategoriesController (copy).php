<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Category;
use App\Module;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Log;
use Purifier;
use Request;
use Route;
use Session;
use Storage;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
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
		$categories = Category::where('parent_id',1)->get();
		// dd($categories);
		$pCats = [];
		// Store the category values into the $cats array
		foreach ($categories as $pcat) {
			$pCats[$pcat->id] = $pcat->name;
		}

		$cats = [];
		// Store the category values into the $cats array
		foreach ($categories as $cat) {
			$cats[$cat->id] = $cat->name;
		}

		$modules = Module::orderBy('name')->get();

		$moduls = [];
		// Store the category values into the $cats array
		foreach ($modules as $module) {
			$moduls[$module->id] = $module->name;
		}
		
		return  view('categories.create', compact('pCats','cats', 'moduls'));
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
		if(!checkPerm('category_delete')) { abort(401, 'Unauthorized Access'); }

		$category = Category::findOrFail($id);
		return view('categories.delete', compact('category'));
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
		// if(!checkACL('manager')) {
		//   return view('errors.403');
		// }

		$category = Category::find($id);
		$category->forceDelete();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

		Session::flash('delete', 'The category was successfully deleted!');
		return redirect()->route('categories.index');
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

		$data = Category::get()->toArray();
		return Excel::create('Categories_List', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
			{
				$sheet->fromArray($data);
			});
		})->download($type);
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
		// if(!checkACL('manager')) {
		//   return view('errors.403');
		// }

		// find all categories in the categories table and pass them to the view
		$modules = Module::orderBy('name')->get();

		$moduls = [];
		// Store the category values into the $cats array
		foreach ($modules as $module) {
		$moduls[$module->id] = $module->name;
		}

		$category = Category::find($id);
		return  view('categories.edit', compact('category'))->withModules($moduls);
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

		$data = Category::get()->toArray();
		return Excel::create('Categories_List', function($excel) use ($data) {
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

		return view('categories.import');
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
		if(!checkACL('admin')) {
			return view('errors.403');
		}

		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {})->get();

			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
					'name'         => $value->name,
					'description'  => $value->description,
					'module_id'    => $value->module_id,
					'created_at'   => $value->created_at,
					'updated_at'   => $value->updated_at,
					];
				}

				if(!empty($insert)){
					DB::table('categories')->insert($insert);
					Session::flash('success','Import was successfull!');
					//return view('roles.index');
					return redirect()->route('categories.index');
					//->with('success','Items imported successfully');;
				}
			}
		}
		return back();
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
	public function index(Request $request, $key=null)
	{
		// Check if user has required permission
	  if(!checkPerm('category_index')) { abort(401, 'Unauthorized Access'); }

		// Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'index');

		// if(!checkACL('manager')) {
		//   // Save entry to log file of failure
		//   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access the index page");
		//   return view('errors.403');
		// }

		$alphas = DB::table('categories')
			->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
			// ->where('published_at', '<', Carbon::now())
         ->where('deleted_at', '=', null)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
			$letters[] = $alpha->letter;
		}

		// $categories = Category::orderBy('name')->get();
		// $categories = Category::with('module')->get();

		// $modules = Module::orderBy('name')->get();

		// $moduls = [];
		// // Store the category values into the $cats array
		// foreach ($modules as $module) {
		// 	$moduls[$module->id] = $module->name;
		// }

		// If $key value is passed
		if ($key) {
			$categories = Category::where('name', 'like', $key . '%')
				->orderBy('name', 'asc')
				->get();
		} else {
   		// No $key value is passed
   		$categories = Category::orderBy('name', 'asc')
   			->get();
      }

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Categories / Index");

		return view ('categories.index', compact('categories','letters'));
	}


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗     ██████╗ █████╗ ████████╗███████╗ ██████╗  ██████╗ ██████╗ ██╗███████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔════╝██╔══██╗╚══██╔══╝██╔════╝██╔════╝ ██╔═══██╗██╔══██╗██║██╔════╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██║     ███████║   ██║   █████╗  ██║  ███╗██║   ██║██████╔╝██║█████╗  ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██║     ██╔══██║   ██║   ██╔══╝  ██║   ██║██║   ██║██╔══██╗██║██╔══╝  ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ╚██████╗██║  ██║   ██║   ███████╗╚██████╔╝╚██████╔╝██║  ██║██║███████╗███████║
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
	public function newCategories(Request $request, $key=null)
	{
		// if(!checkACL('guest')) {
		//     return view('errors.403');
		// }

		// Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'newCategories');

		//$alphas = range('A', 'Z');
		$alphas = DB::table('categories')
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
			$categories = Category::newCategories()
				->where('name', 'like', $key . '%')
				->get();
		} else {
			$categories = Category::newCategories()->get();
		}

		return view('categories.newCategories', compact('categories','letters'));
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
		// if(!checkACL('guest')) {
		//     return view('errors.403');
		// }

		$category = Category::findOrFail($id);

		// Add 1 to views column
		//DB::table('articles')->where('id','=',$article->id)->increment('views',1);

		// Save entry to log file using built-in Monolog
		// if (Auth::check()) {
		//     Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED article (" . $article->id . ")");
		// } else {
		//     Log::info('Guest viewed article (' . $article->id) . ')';
		// }

		return view('categories.show', compact('category'));
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
	public function store(CreateCategoryRequest $request)
	{
		// if(!checkACL('manager')) {
		//   return view('errors.403');
		// }

		$category = new Category;
			$category->name = $request->name;
			$category->value = $request->value;
			$category->description = $request->description;
			$category->module_id = $request->module_id;
		$category->save();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

		Session::flash('store','The new category has been created.');
		return redirect()->route('categories.index');
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
	public function update(UpdateCategoryRequest $request, $id)
	{
		// if(!checkACL('manager')) {
		//   return view('errors.403');
		// }

		// Get the category value from the database
		$category = Category::find($id);
			$category->name = $request->input('name');
			$category->value = $request->input('value');
			$category->description = $request->input('description');
			$category->module_id = $request->input('module_id');
		// Save the data to the database
		$category->save();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

		// Set flash data with success message
		Session::flash ('update', 'The category was successfully updated!');
		// Redirect to posts.show
		return redirect()->route('categories.index');
	}

}
