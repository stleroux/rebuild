<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Projects\Project;
use App\Models\Projects\Image;
use Session;
use Image;
use File;

class ImagesController extends Controller
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
      // only allow authenticated users to access these pages
      //$this->middleware('auth', ['except'=>['index','show']]);
      // changing auth to guest would only allow guests to access these pages
      // you can also restrict the actions by adding ['except' => 'name_of_action'] at the end
      $this->middleware('auth');

      //Log::useFiles(storage_path().'/logs/articles.log');
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
   // public function create($project_id)
   // {
   //    return view('woodProjectImages.create', compact('project_id'));
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
   public function destroy($id)
   {
      $image = woodProjectImage::find($id);

      unlink(public_path('_woodProjects/images/' . $image->wood_project_id . "/" . $image->new_name));
      unlink(public_path('_woodProjects/images/thumbs/' . $image->wood_project_id . "/" . $image->new_name));
      $image->delete();

      // Check if there are any files left in the folder, if not, delete the folder and thumbs folder
      if (count(glob('_woodProjects/images/' . $image->wood_project_id . "/*")) === 0 ) { // empty
         // Delete the IMAGES/THUMBS folder matching the album id
         File::deleteDirectory(public_path('_woodProjects/images/thumbs/' . $image->wood_project_id));
         // Delete the IMAGES folder matching the album id
         File::deleteDirectory(public_path('_woodProjects/images/' . $image->wood_project_id));
      }
      
      Session::flash('success','Image deleted.');
      return redirect(route('woodProjectImages.index', $image->wood_project_id));
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
   public function index($id)
   {
      $project = WoodProject::findOrFail($id);
      $images = WoodProjectImage::where('wood_project_id', $id)->get();

      return view('woodProjectImages.index', compact('project','images'));
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
      $image = woodProjectImage::find($id);

      return view('woodProjectImages.show', compact('image'));
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
      // Get the file object
      $file = $request->file('image');

      // Get file name with extension
      $filenameWithExt = $request->file('image')->getClientOriginalName();

      // Get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Get the extension
      $extension = $request->file('image')->getClientOriginalExtension();

      // Create the new filename
      $filenameToStore = $filename . '_' . time() . '.' . $extension;

      // Upload image
      // Check if folders exists
      if (!file_exists('_projects/images/'.$request->input('project_id'))) {
         mkdir('_projects/images/' . $request->input('project_id'), 0777, true);
      }

      // move the file to the correct location
      $file->move('_projects/images/' . $request->input('project_id') . "/", $filenameToStore);
      
      // Check if Thumbs folder exists under Images
      if (!file_exists('_projects/images/thumbs/'.$request->input('project_id'))) {
         mkdir('_projects/images/thumbs/' . $request->input('project_id'), 0777, true);
      }

      // Create thumbnail
      $thumb = Image::make('_projects/images/' . $request->input('project_id') . "/" . $filenameToStore)
         ->resize(240,160)
         ->save('_projects/images/thumbs/' . $request->input('project_id') . "/" . $filenameToStore, 60);

      //Create photo record in DB
      $image = new Image;
         $image->wood_project_id = $request->input('project_id');
         $image->ori_name = $request->input('ori_name');
         $image->new_name = $filenameToStore;            
         $image->size = $request->file('image')->getClientSize();
         $image->description = $request->input('description');
      $image->save();

      Session::flash('success','Image uploaded.');
      return redirect('/woodProjectImages/'. $request->input('project_id').'/manageImages');
   }

}
