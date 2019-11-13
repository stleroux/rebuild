<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Articles\Article;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Log;
use PDF;
use Purifier;
use Route;
use Session;
use Storage;
use Table;
use URL;

class FunctionsController extends ArticlesController
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
      $this->enablePermissions = true;
   }


##################################################################################################################
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗     █████╗ ██████╗ ██████╗ 
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔══██╗██╔══██╗
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ███████║██║  ██║██║  ██║
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██║██║  ██║██║  ██║
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║██████╔╝██████╔╝
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚═════╝ ╚═════╝ 
##################################################################################################################
   public function favoriteAdd($id)
   {
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('article_')) { abort(401, 'Unauthorized Access'); }
      // }

      $article = Article::find($id);
      $article->addFavorite();

      Session::flash ('success','The article was successfully added to your Favorites list!');
      return redirect()->back();
   }


##################################################################################################################
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗    ██████╗ ███████╗███╗   ███╗ ██████╗ ██╗   ██╗███████╗
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝████╗ ████║██╔═══██╗██║   ██║██╔════╝
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ██████╔╝█████╗  ██╔████╔██║██║   ██║██║   ██║█████╗  
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██╔══╝  
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║███████╗██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ███████╗
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚══════╝
##################################################################################################################
   public function favoriteRemove($id)
   {
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('recipe_favorite')) { abort(401, 'Unauthorized Access'); }
      // }

      $article = Article::find($id);
      $article->removeFavorite();

      Session::flash ('success','The article was successfully removed to your Favorites list!');
      return redirect()->back();
   }


}