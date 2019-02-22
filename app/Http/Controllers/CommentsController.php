<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use Modules\Posts\Entities\Post;
use DB;
use Session;
use Log;
use Auth;
use URL;
//use Request;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentsController extends Controller
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
			$this->middleware('auth', ['except' => 'store']);
			//Log::useFiles(storage_path().'/logs/comments.log');
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
		$comment = Comment::find($id);
		return view('comments.delete')->withComment($comment);
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
		$comment = Comment::find($id);
		//$post_id = $comment->post->id;
		$comment->delete();

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED comment (" . $comment->id . ")\r\n", 
		//     [json_decode($comment, true)]
		// );

		Session::flash('delete', 'Comment Deleted');
		return redirect()->route('comments.index');
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
		$comment = Comment::find($id);

		return view('comments.edit')->withComment($comment);
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
		// if(!checkACL('manager')) {
		//   // Save entry to log file of failure
		//   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access the index page");
		//   return view('errors.403');
		// }

		// Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'index');


		// $categories = Category::orderBy('name')->get();
		$comments = Comment::orderBy('id','desc')->get();

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Categories / Index");

		return view ('comments.index', compact('comments'));
	}


		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		// public function store(CreateCommentRequest $request, $post_id)
		// {
		//     $post = Post::find($post_id);

		//     $comment = new Comment();
		//         $comment->name = $request->name;
		//         $comment->email = $request->email;
		//         $comment->comment = $request->comment;
		//         $comment->approved = true;
		//         $comment->post()->associate($post);
		//     $comment->save();

				// Save entry to log file using built-in Monolog
				// if (Auth::check()) {
				//     Log::info(Auth::user()->username . " (" . Auth::user()->id . ") commented on post (" . $post->id . ")\r\n", [json_decode($comment, true)]);
				// } else {
				//     Log::info(Request::ip() . " commented on post " . $post->id);
				// }

				//Session::flash('success', 'Comment was added');
				//return redirect()->route('frontend.blog.single', [$post->slug]);
		//}


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗     ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   ███████║
# ═╝  ╚═══╝╚══════╝ ╚══╝╚══╝      ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
	public function newComments(Request $request, $key=null)
	{
		// if(!checkACL('guest')) {
		//     return view('errors.403');
		// }

		//$alphas = range('A', 'Z');
		// $alphas = DB::table('comments')
		//    ->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
		//    ->where('created_at', '>=' , Auth::user()->last_login_date)
		//    //->where('user_id', '=', Auth::user()->id)
		//    // ->where('personal', '!=', 1)
		//    // ->where('published_at','!=', null)
		//    ->orderBy('letter')
		//    ->get();
		// //dd($alphas);

		// $letters = [];
		// foreach($alphas as $alpha) {
		//   $letters[] = $alpha->letter;
		// }

		// If $key value is passed
		// if ($key) {
		//    $comments = Comment::newComments()
		//       ->where('name', 'like', $key . '%')
		//       ->get();
		//    return view('comments.newComments', compact('comments','letters'));
		// }


	// if(!checkACL('manager')) {
	//   // Save entry to log file of failure
	//   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access the index page");
	//   return view('errors.403');
	// }

	// $categories = Category::orderBy('name')->get();
	$comments = Comment::where('created_at', '>=' , Auth::user()->last_login_date)->get();

	// Save entry to log file using built-in Monolog
	//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Categories / Index");

	//  return view ('comments.index', compact('comments'));
	// }
		//$comments = Comment::newComments()->get();
		return view('comments.newComments', compact('comments'));
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
		//dd($id);

		$comment = Comment::find($id);
		//dd($comment);
		//$nid = $comment->post_id;
		//dd($nid);
		return view('comments.show')->withComment($comment);
		//return view('comments.show', compact('comment'));
		// return redirect()->route('comments.show', compact('comment'));
		// return redirect()->route('comments.index');
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
	public function update(UpdateCommentRequest $request, $id)
	{
		$comment = Comment::find($id);
			$comment->comment = $request->comment;
		$comment->save();

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED comment (" . $comment->id . ")\r\n", 
		//     [json_decode($comment, true)]
		// );

		Session::flash('update', 'Comment updated successfully.');
		
		
		if($request->page === 'showPost'){
			return redirect()->route('posts.show', $comment->commentable_id);
		}

		return redirect()->route('comments.index');
	}


}
