<?php

namespace App\Http\Controllers\Admin\Movies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Movies\Movie;
use Carbon\Carbon;
use DB;
use File;
use Session;

class MoviesController extends Controller
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
		$this->enablePermissions = false;
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
		if($this->enablePermissions)
		{
				if(!checkPerm('movie_create')) { abort(401, 'Unauthorized Access'); }
		}

		$movie = New Movie();

		return view('admin.movies.create', compact('movie'));
	}


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
// 
##################################################################################################################
	public function delete($id)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('movie_trash')) { abort(401, 'Unauthorized Access'); }
		}

		$movie = Movie::onlyTrashed()->findOrFail($id);

		return view('admin.movies.delete', compact('movie'));
	}



##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝  
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
	public function deleteDestroy($id)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('movie_delete')) { abort(401, 'Unauthorized Access'); }
		}

		$movie = Movie::withTrashed()->findOrFail($id);

		// Delete the associated image if any
		File::delete('_movies/' . $movie->image);

		$movie->forceDelete();

		Session::flash('success', 'The movie was successfully deleted!');
		return redirect()->route('admin.movies.trashed');
	}


// ##################################################################################################################
// # ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
// # ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
// # ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
// # ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
// # ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
// # ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝   
// // Remove the specified resource from storage
// // Used in the index page and trashAll action to soft delete multiple records
// ##################################################################################################################
//     public function destroy(Movie $movie)
//     {
//         // Check if user has required permission
//         if($this->enablePermissions)
//         {
//             if(!checkPerm('movie_delete')) { abort(401, 'Unauthorized Access'); }
//         }

//         $movie->delete();

//         // Set flash data with success message
//         Session::flash('delete','The movie was deleted successfully.');
//         // Redirect
//         return redirect()->route('admin.movies.index');
//     }


// ##################################################################################################################
// # ██████╗ ███████╗██╗     ███████╗████████╗███████╗
// # ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
// # ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
// # ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
// # ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
// # ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
// // Mass Delete selected rows - all selected records
// ##################################################################################################################
//     public function delete(Movie $movie)
//     {
//         // Check if user has required permission
//         if($this->enablePermissions)
//         {
//             if(!checkPerm('movie_delete')) { abort(401, 'Unauthorized Access'); }
//         }

//         return view('admin.movies.delete', compact('movie'));
//     }


##################################################################################################################
# ███████╗██████╗ ██╗████████╗
# ██╔════╝██╔══██╗██║╚══██╔══╝
# █████╗  ██║  ██║██║   ██║   
# ██╔══╝  ██║  ██║██║   ██║   
# ███████╗██████╔╝██║   ██║   
# ╚══════╝╚═════╝ ╚═╝   ╚═╝   
// Show the form for editing the specified resource
##################################################################################################################
	public function edit(Movie $movie, $id)
	{
		// Check if user has required permission
		if($this->enablePermissions)
		{
			if(!checkPerm('movie_edit')) { abort(401, 'Unauthorized Access'); }
		}

		// Find the model to edit
		$movie = Movie::find($id);
		return view('admin.movies.edit', compact('movie'));
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
			 if(!checkPerm('movie_browse')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('movies')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('published_at','<', Carbon::Now())
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
			$letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$movies = Movie::with('user')->published()
				->sortable()
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->paginate(15);
			return view('admin.movies.index', compact('movies','letters'));
		}

		// No $key value is passed
		// $movies = Movie::with('user')->published()->get();
		$movies = Movie::published()->sortable()->orderBy('title', 'asc')->paginate(15);

		// Required to be able to list the "catagories" in the search block
		$movie = New Movie();

		return view('admin.movies.index', compact('movies','letters','movie'));
		// return view('admin.movies.index', compact('movies','letters'));
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
		// Check if user has required permission
		if($this->enablePermissions)
		{
				if(!checkPerm('movie_show')) { abort(401, 'Unauthorized Access'); }
		}

		$movie = Movie::findOrFail($id);

		// get the title of the next movie
		$nextTitle = Movie::published()->where('title', '>', $movie->title)->orderBy('title','desc')->min('title');

		if($nextTitle){
			$next = Movie::published()->where('title', $nextTitle)->first();
			$next = $next->id;
		}

		// get the title of the previous movie
		$previousTitle = Movie::published()->where('title', '<', $movie->title)->orderBy('title','asc')->max('title');

		if($previousTitle){
			$previous = Movie::published()->where('title', $previousTitle)->first();
			$previous = $previous->id;
		}

		return view('admin.movies.show', compact('movie','next','previous'));
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
	public function store()
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			 if(!checkPerm('movie_add')) { abort(401, 'Unauthorized Access'); }
		}

		Movie::create($this->validateRequest());

		Session::flash('success','The movie has been created successfully!');
		return redirect()->route('admin.movies.index');
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
	public function update(Movie $movie, $id)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('movie_edit')) { abort(401, 'Unauthorized Access'); }
		}

		$movie = Movie::findOrFail($id);
		$movie->update($this->validateRequest());
		
		Session::flash('success','The movie has been updated successfully.');
		return redirect(Session::get('fromPage'));
	}


##################################################################################################################
#██╗   ██╗ █████╗ ██╗     ██╗██████╗  █████╗ ████████╗███████╗    ██████╗ ███████╗ ██████╗ ██╗   ██╗███████╗███████╗████████╗
#██║   ██║██╔══██╗██║     ██║██╔══██╗██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔═══██╗██║   ██║██╔════╝██╔════╝╚══██╔══╝
#██║   ██║███████║██║     ██║██║  ██║███████║   ██║   █████╗      ██████╔╝█████╗  ██║   ██║██║   ██║█████╗  ███████╗   ██║   
#╚██╗ ██╔╝██╔══██║██║     ██║██║  ██║██╔══██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║▄▄ ██║██║   ██║██╔══╝  ╚════██║   ██║   
# ╚████╔╝ ██║  ██║███████╗██║██████╔╝██║  ██║   ██║   ███████╗    ██║  ██║███████╗╚██████╔╝╚██████╔╝███████╗███████║   ██║   
#  ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
##################################################################################################################
	private function validateRequest()
	{
		return request()->validate([
			'title' => 'required',
			'col_no' => 'required',
			'category' => 'required',
			'published_at' => '',
			'running_time' => '',
			'original_title' => '',
			'upc' => '',
			'rating' => '',
			'studio' => '',
			'production_year' => '',
			'overview' => ''
		]);
	}

}
