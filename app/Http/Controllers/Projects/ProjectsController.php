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
            if(!checkPerm('projects_create')) { abort(401, 'Unauthorized Access'); }
        }

        $project = New Project();
        // Get all categories
        $categories = Category::where('parent_id',12)->get();
        // dd($categories);

        return view('projects.create', compact('project','categories'));
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
            if(!checkPerm('projects_delete')) { abort(401, 'Unauthorized Access'); }
        }

        return view('projects.delete', compact('project'));
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
            if(!checkPerm('projects_delete')) { abort(401, 'Unauthorized Access'); }
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
        return redirect()->route('projects.list');
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
            if(!checkPerm('projects_edit')) { abort(401, 'Unauthorized Access'); }
        }

        // dd($project);
        $project = Project::with('finishes')->with('materials')->with('images')->find($project->id);
        // ->get();
        // dd($project);

        // Get all categories
        // $categories = Category::where('parent_id',12)->get();
        $materials = Material::all();
        // dd($materials);
        $finishes = Finish::all();
        // $images = Image::where('project_id', 3)->get();
        // dd($images);

        // return view('projects.edit', compact('project','categories','materials'));
        return view('projects.edit', compact('project','finishes','materials'));
        // return view('projects.edit', compact('project'));
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

        if($filter){
            $projects = Project::with('images')->where('category', '=', $filter)->paginate(12);
            // dd($projects);
        } else {
            $projects = Project::with('images')->orderBy('name','asc')->paginate(12);
        }
        // $projects = Project::with('images')->latest()->limit(20)->get();
        
        return view('projects.index', compact('projects','project'));
    }


##################################################################################################################
# ██╗     ██╗███████╗████████╗
# ██║     ██║██╔════╝╚══██╔══╝
# ██║     ██║███████╗   ██║   
# ██║     ██║╚════██║   ██║   
# ███████╗██║███████║   ██║   
# ╚══════╝╚═╝╚══════╝   ╚═╝  
// Display a list of resources in Backend
##################################################################################################################
    public function list()
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('projects_list')) { abort(401, 'Unauthorized Access'); }
        }

        // Set the session to the current page route
        Session::put('fromPage', url()->full());

        // $projects = Project::All();
        $projects = Project::with('images')->orderBy('name','asc')->get();
        return view('projects.list', compact('projects'));
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
        Project::create($this->validateRequest());

        return redirect()->route('projects.list');
        // return redirect('projects.edit', $project);
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

        // Get the first image associated to this project
        $image = Image::where('project_id', '=', $project->id)->first();

        return view('projects.show', compact('project', 'image'));
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
        $project->update($this->validateRequest());

        return redirect()->route('projects.list');
    }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗     ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗      ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗    ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝     ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
    // public function storeComment(CreateCommentRequest $request, $id)
    // {
    //     $project = project::find($id);

    //     $comment = new Comment();
    //         $comment->user_id = Auth::user()->id;
    //         $comment->comment = $request->comment;
    //         $project->comments()->save($comment);
    //     $comment->save();

    //     Session::flash('success', 'Comment added succesfully.');
    //     return redirect()->route('projects.show', $project->id);
    // }


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