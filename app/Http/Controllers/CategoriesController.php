<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Module;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Log;
use Purifier;
use Route;
use Session;
use Storage;
// use App\Http\Requests\CreateCategoryRequest;
// use App\Http\Requests\UpdateCategoryRequest;

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
		$this->middleware('auth');
      $this->enablePermissions = true;
      // If set to false, users will be able to access the different functions using the address bar
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
		if($this->enablePermissions) {
			if(!checkPerm('category_create')) { abort(401, 'Unauthorized Access'); }
		}

		$categories = Category::with('children')->where('parent_id','=',0)->orderBy('name')->get();
		
		return view('categories.create', compact('categories'));
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
		$category = Category::findOrFail($id);

		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('category_delete')) { abort(401, 'Unauthorized Access'); }
		}

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
		$category = Category::find($id);

		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('category_delete')) { abort(401, 'Unauthorized Access'); }
		}

		$category->forceDelete();

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
		$category = Category::find($id);

		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('category_edit', $category)) { abort(401, 'Unauthorized Access'); }
		}

		return  view('categories.edit', compact('category'));
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
					return redirect()->route('categories.index');
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
		if($this->enablePermissions) {
			if(!checkPerm('category_index')) { abort(401, 'Unauthorized Access'); }
		}

		$alphas = DB::table('categories')
			->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
         ->where('deleted_at', '=', null)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
			$letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$categories = Category::with('parent','children')->where('name', 'like', $key . '%')
				->orderBy('name', 'asc')
				->get();
		} else {
   		// No $key value is passed
   		$categories = Category::with('parent','children')->orderBy('name', 'asc')->get();
      }

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
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('category_new')) { abort(401, 'Unauthorized Access'); }
		}

		//$alphas = range('A', 'Z');
		$alphas = DB::table('categories')
			->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
			->where('created_at', '>=' , Auth::user()->last_login_date)
			->orderBy('letter')
			->get();

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
		$category = Category::findOrFail($id);

		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('category_show')) { abort(401, 'Unauthorized Access'); }
		}

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
	public function store(Request $request)
	{
		// Check if user has required module
		if($this->enablePermissions) {
			if(!checkPerm('category_create')) { abort(401, 'Unauthorized Access'); }
		}

		if($request->part === 'main')
		{
			$rules = [
				'mName' => 'required|min:3|max:50',
			];

			$customMessages = [
				'mName.required' => 'Required',
				'mName.min' => 'Minimum 3 characters',
				'mName.max' => 'Maximum 50 characters',
			];

			$this->validate($request, $rules, $customMessages);

			$category = new Category;
				$category->parent_id = 0;
				$category->name = $request->mName;
				$category->value = $request->mValue;
				$category->description = $request->mDescription;
			$category->save();

			Session::flash('store','The new parent category has been created.');
			return redirect()->route('categories.create');
		} 

		if($request->part === 'sub')
		{
			$rules = [
				'sSubs' => 'required',
				'sName' => 'required|min:3|max:50',
			];

			$customMessages = [
				'sSubs.required' => 'Required',
				'sName.required' => 'Required',
				'sName.min' => 'Minimum 3 characters',
				'sName.max' => 'Maximum 50 characters',
			];

			$this->validate($request, $rules, $customMessages);

			$category = new Category;
				$category->parent_id = $request->sSubs;
				$category->name = $request->sName;
				$category->value = $request->sValue;
				$category->description = $request->sDescription;
			$category->save();

			Session::flash('store','The new sub-category has been created.');
			return redirect()->route('categories.create');
		}

		if($request->part === 'category')
		{
			$rules = [
				'cCategory' => 'required',
				'cSubcategory' => 'required',
				'cName' => 'required|min:3|max:50',
			];

			$customMessages = [
				'cCategory.required' => 'Required',
				'cSubcategory.required' => 'Required',
				'cName.required' => 'Required',
				'cName.min' => 'Minimum 3 characters',
				'cName.max' => 'Maximum 50 characters',
			];

			$this->validate($request, $rules, $customMessages);

			$cSubCategory = Category::
				where('name', '=', $request->cSubcategory)
				->where('parent_id', '=', $request->cCategory)
				->pluck('id');

			$category = new Category;
				$category->parent_id = $cSubCategory[0];
				$category->name = $request->cName;
				$category->value = $request->cValue;
				$category->description = $request->cDescription;
			$category->save();

			Session::flash('store','The new category has been created.');
			return redirect()->route('categories.index');
		}
		
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
		// Get the category value from the database
		$category = Category::find($id);

		// Check if user has required module
		if($this->enablePermissions) {
			if(!checkPerm('category_edit')) { abort(401, 'Unauthorized Access'); }
		}

			$category->name = $request->input('name');
			$category->value = $request->input('value');
			$category->description = $request->input('description');
		// Save the data to the database
		$category->save();

		// Set flash data with success message
		Session::flash ('update', 'The category was successfully updated!');
		// Redirect
		return redirect()->route('categories.index');
	}


}
