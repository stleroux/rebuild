<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Projects\Project;
use App\Models\Projects\Finish;
use App\Models\Projects\Material;
use App\Models\Projects\Image;
use Illuminate\Http\Request;
use DB;
use File;
use Image as Img;
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

        // Delete the associated images if any
        foreach ($project->images as $image) {
            File::delete('_projects/' . $image->name);
        }

        // Delete the project and related images, materials and finishes in the database
        $project->delete();

        // Set flash data with success message
        Session::flash('delete','The project, related files and DB entries were deleted successfully.');
        // Redirect
        return redirect()->route('projects.index');
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
    public function index()
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('projects_index')) { abort(401, 'Unauthorized Access'); }
        }

        // $projects = Project::with('images')->latest()->limit(20)->get();
        $projects = Project::with('images')->orderBy('name','asc')->paginate(3);
        return view('projects.index', compact('projects'));
    }


##################################################################################################################
# ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
# ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
# ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
# ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
# ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
# ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
// Display a list of resources in Backend
##################################################################################################################
    public function list()
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('projects_list')) { abort(401, 'Unauthorized Access'); }
        }

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

        return redirect('projects');
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

        // Increase the view count since this is viewed from the frontend
        // dd(url('') . '/projects');

        if (url()->previous() == url('') . '/projects') {
            DB::table('projects-projects')->where('id','=',$project->id)->increment('views',1);
        }

        $image = Image::where('project_id', '=', $project->id)->first();
        // dd($image);

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

        return redirect('projects');
    }


##################################################################################################################
    public function addMaterial(Request $request, $id)
    {
        $project = Project::find($id);
        $project->materials()->syncWithoutDetaching($request->material);

        return redirect()->back();
    }


##################################################################################################################
    public function removeMaterial(Request $request, $id)
    {
        DB::table('projects-material_project')
            ->where('project_id', '=', $request->project_id)
            ->where('material_id', '=', $id)
            ->delete();

        return redirect()->back();
    }


##################################################################################################################
    public function addFinish(Request $request, $id)
    {
        $project = Project::find($id);
        $project->finishes()->syncWithoutDetaching($request->finish);

        return redirect()->back();
    }


##################################################################################################################
    public function removeFinish(Request $request, $id)
    {
        DB::table('projects-finish_project')
            ->where('project_id', '=', $request->project_id)
            ->where('finish_id', '=', $id)
            ->delete();

        return redirect()->back();
    }


##################################################################################################################
    public function addImage(Request $request, $id)
    {
        $project = Project::find($id);
        // $image_count = $project->images()->count();

        // Check if a new image was submitted
        if ($request->hasFile('image')) {
            //Add new photo
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('_projects/' . $filename);
            Img::make($image)->resize(800, 400)->save($location);
        }
      
        $img = New Image();
            $img->project_id = $id;
            $img->name = $filename;
            $img->description = $request->description;
        $img->save();

        return redirect()->back();
    }


##################################################################################################################
    public function removeImage(Request $request, $id)
    {
        // Find the image ID
        $image = Image::find($id);

        // Delete file from storage
        $image_path = public_path().'/_projects/'.$image->name;
        unlink($image_path);

        // Delete DB entry
        $image->delete($image->id);

        return redirect()->back();
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
            'category' => 'required',
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