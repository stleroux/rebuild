<?php

namespace App\Http\Controllers\Admin\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Articles\Article;
use Carbon\Carbon;
use DB;
use File;
use Session;

class ArticlesController extends Controller
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
            if(!checkPerm('article_create')) { abort(401, 'Unauthorized Access'); }
        }

        $article = New Article();

        return view('admin.articles.create', compact('article'));
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
         if(!checkPerm('article_trash')) { abort(401, 'Unauthorized Access'); }
      }

      $article = Article::onlyTrashed()->findOrFail($id);

      return view('admin.articles.delete', compact('article'));
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
         if(!checkPerm('article_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $article = Article::withTrashed()->findOrFail($id);

      // Delete the associated image if any
      File::delete('_articles/' . $article->image);

      $article->forceDelete();

      Session::flash('success', 'The article was successfully deleted!');
      return redirect()->route('admin.articles.trashed');
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
//     public function destroy(Article $article)
//     {
//         // Check if user has required permission
//         if($this->enablePermissions)
//         {
//             if(!checkPerm('article_delete')) { abort(401, 'Unauthorized Access'); }
//         }

//         $article->delete();

//         // Set flash data with success message
//         Session::flash('delete','The article was deleted successfully.');
//         // Redirect
//         return redirect()->route('admin.articles.index');
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
//     public function delete(Article $article)
//     {
//         // Check if user has required permission
//         if($this->enablePermissions)
//         {
//             if(!checkPerm('article_delete')) { abort(401, 'Unauthorized Access'); }
//         }

//         return view('admin.articles.delete', compact('article'));
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
    public function edit(Article $article, $id)
    {
        // Check if user has required permission
        if($this->enablePermissions)
        {
            if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
        }

        // Find the model to edit
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article'));
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
         if(!checkPerm('article_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('articles')
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
         $articles = Article::with('user')->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('admin.articles.index', compact('articles','letters', 'archivesLinks'));
      }

      // No $key value is passed
      $articles = Article::with('user')->published()->get();
      return view('admin.articles.index', compact('articles','letters', 'archivesLinks'));
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
            if(!checkPerm('article_show')) { abort(401, 'Unauthorized Access'); }
        }

        $article = Article::findOrFail($id);

        // get previous article id
        $previous = Article::published()->where('id', '<', $article->id)->max('id');

        // get next article id
        $next = Article::published()->where('id', '>', $article->id)->min('id');

        return view('admin.articles.show', compact('article','articlelinks','next','previous'));
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
         if(!checkPerm('article_add')) { abort(401, 'Unauthorized Access'); }
      }

      Article::create($this->validateRequest());

      Session::flash('success','The article has been created successfully!');
      return redirect()->route('admin.articles.index');
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
   public function update(Article $article, $id)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
      }

      $article = Article::findOrFail($id);
      $article->update($this->validateRequest());
      
      Session::flash('success','The article has been updated successfully.');
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
            'name' => 'required',
            'email' => 'required',
            'status' => 'required',
        ]);
    }

}
