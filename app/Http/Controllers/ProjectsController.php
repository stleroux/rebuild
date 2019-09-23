<?php

namespace App\Http\Controllers\Projects;

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
      $this->enablePermissions = false;
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
    public function index($filter = null)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('projects_index')) { abort(401, 'Unauthorized Access'); }
        }

        // Set the session to the current page route
        Session::put('fromPage', url()->full());

        $project = New Project();

        if($filter) {
            if($filter == 1000) {
                $projects = Project::with('images')->orderBy('id','desc')->take(4)->get();
                return view('projects.index', compact('projects','project'));
            }

            $projects = Project::with('images')->where('category', '=', $filter)->paginate(8);

        } else {
            $projects = Project::with('images')->orderBy('name','asc')->paginate(8);
        }
        
        return view('projects.index', compact('projects','project'));
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
            if(!checkPerm('projects_show')) { abort(401, 'Unauthorized Access'); }
        }

        // Increase the view count if viewed from the frontend
        if (url()->previous() != url('/projects/list')) {
            DB::table('projects__projects')->where('id','=',$project->id)->increment('views',1);
        }

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

        return view('projects.show', compact('project','image','previous','next'));
    }
}