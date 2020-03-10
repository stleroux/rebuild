<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Projects\Project;
use App\Models\Projects\Finish;
use App\Models\Projects\Material;
use App\Models\Projects\Image;
use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use Image as Img;
use Route;
use Session;
use URL;

class ProjectsController extends Controller
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
      $this->middleware('auth')->except('index','show');
      $this->enablePermissions = true;
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
         if(!checkPerm('project_add')) { abort(401, 'Unauthorized Access'); }
      }

      $project = New Project();

      return view('admin.projects.create', compact('project'));
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
    public function delete(Project $project)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_delete')) { abort(401, 'Unauthorized Access'); }
        }

        return view('admin.projects.delete', compact('project'));
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
    public function destroy(Project $project)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_delete')) { abort(401, 'Unauthorized Access'); }
        }

        // Delete images from file system
        $images = DB::table('projects__images')->where('project_id', '=', $project->id)->get();

        if($images) {
            foreach($images as $image) {
                // Delete the image(s) and thumbnail(s) from storage
                $image_path = public_path().'/_projects/'.$project->id.'/'.$image->name;
                $thumbs_path = public_path().'/_projects/'.$project->id.'/thumbs/'.$image->name;
                unlink($image_path);
                unlink($thumbs_path);
            }
        }

        // Check if there are any files left in the thumbs folder, if not, delete the folder
        if (count(glob('_projects/' . $project->id . "/thumbs/*")) === 0 ) { // empty
            // Delete the thumbs folder
            File::deleteDirectory(public_path('_projects/'.$project->id.'/thumbs/'));
            // Delete the main folder
            File::deleteDirectory(public_path('_projects/' . $project->id));
        }

        // Delete related images from DB
        DB::table('projects__images')->where('project_id', '=', $project->id)->delete();

        // Delete related materials from DB
        DB::table('projects__material_project')->where('project_id', '=', $project->id)->delete();

        // Delete related finishes from DB
        DB::table('projects__finish_project')->where('project_id', '=', $project->id)->delete();

        // Delete the project from the database
        $project->delete();

        // Set flash data with success message
        Session::flash('delete','The project, related files and DB entries were deleted successfully.');
        // Redirect
        return redirect()->route('admin.projects.index');
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
    public function edit(Project $project)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_edit')) { abort(401, 'Unauthorized Access'); }
        }

        $project = Project::with('finishes')->with('materials')->with('images')->find($project->id);

        $materials = Material::all();
        $finishes = Finish::all();

        return view('admin.projects.edit', compact('project','finishes','materials'));
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
    // public function index($filter = null)
    // {
    //     // Check if user has required permission
    //     if($this->enablePermissions)
    //     {
    //         if(!checkPerm('project_index')) { abort(401, 'Unauthorized Access'); }
    //     }

    //     // Set the session to the current page route
    //     Session::put('fromPage', url()->full());

    //     $project = New Project();

    //     if($filter) {
    //         if($filter == 1000) {
    //             $projects = Project::with('images')->orderBy('id','desc')->take(4)->get();
    //             return view('projects.index', compact('projects','project'));
    //         }

    //         $projects = Project::with('images')->where('category', '=', $filter)->paginate(8);

    //     } else {
    //         $projects = Project::with('images')->orderBy('name','asc')->paginate(8);
    //     }
        
    //     return view('projects.index', compact('projects','project'));
    // }


##################################################################################################################
# ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
# ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
# ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
# ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
# ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
# ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
// Display a list of resources in Backend
##################################################################################################################
    public function index()
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_browse')) { abort(401, 'Unauthorized Access'); }
        }

        // Set the session to the current page route
        Session::put('fromPage', url()->full());

        $projects = Project::with('images')->orderBy('name','asc')->get();

        return view('admin.projects.index', compact('projects'));
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
        if($this->enablePermissions)
        {
            if(!checkPerm('project_add')) { abort(401, 'Unauthorized Access'); }
        }

        Project::create($this->validateRequest());

        return redirect()->route('admin.projects.index');
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
    public function show(Project $project, Request $request)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_read')) { abort(401, 'Unauthorized Access'); }
        }

        // Increase the view count if viewed from the frontend
        // if (url()->previous() != url('/projects/list')) {
        //     DB::table('projects__projects')->where('id','=',$project->id)->increment('views',1);
        // }

        // get previous project
        $previous = Project::where('name', '<', $project->name)->orderBy('name','asc')->max('name');
        if($previous){
            $p = Project::where('name',$previous)->get();
            $previous = $p[0]->id;
        }

        // get next project
        $next = Project::where('name', '>', $project->name)->orderBy('name','desc')->min('name');
        if($next){
            $n = Project::where('name',$next)->get();
            $next = $n[0]->id;
        }

        // Get the first image associated to this project
        $image = Image::where('project_id', '=', $project->id)->first();

        return view('admin.projects.show', compact('project','image','previous','next'));
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
    public function update(Project $project)
    {
         // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('project_edit')) { abort(401, 'Unauthorized Access'); }
        }

        $project->update($this->validateRequest());

        return redirect()->route('admin.projects.index');
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
            'name' => 'required',
            'category' => 'required|min:0|not_in:0',
            'description' => 'required',
            'width' => '',
            'depth' => '',
            'height' => '',
            'completed_at' => '',
            'weight' => '',
            'price' => '',
            'time_invested' => '',
            'image' => 'sometimes|file|image|max:5000',
        ]);
    }

}