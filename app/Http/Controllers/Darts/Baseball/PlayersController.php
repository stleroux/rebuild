<?php

namespace App\Http\Controllers\Darts\Baseball;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Darts\Game;
use App\Models\Darts\Score;
use App\Models\User;

class PlayersController extends Controller
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
# ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
# ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
# ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
# ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
# ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
# ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
// Display a list of resources
##################################################################################################################
   public function index($gameID)
   {
      $game = Game::find($gameID);
      // $players = zeroOnePlayers($gameID);
      // $nextShot = zeroOneNextShot($gameID);
      // $player = DB::table('dart__players')->where('game_id', $gameID)->where('shooting_order', $nextShot)->first();
      // $user = User::where('id', $player->user_id)->first();
      // $remainingScore = $game->type - zeroOnePlayerScore($gameID, $player->user_id)->sum('score');

      // // Check if any one of the players has won the game (remaining score = 0)
      // $gameOver = DB::table('dart__scores')->where('game_id', $gameID)->where('remaining', 0)->first();
      
      // foreach($players as $p){
      //    if ($gameOver){
      //       $gameDone = 1;
      //    } else {
      //       $gameDone = 0;
      //    }
      // }

      // return view('darts.01.players.index', compact('game','nextShot','players','player','user','remainingScore','gameDone'));
      $innings = [1,2,3,4,5,6,7,8,9];
      $players = baseballPlayers($gameID);
      $scores = [1,2,3,4,5,6,7,8,9];

      return view('darts.baseball.players.index', compact('game','innings','players','scores'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
##################################################################################################################
   public function store(Request $request)
   {
      // $this->validate($request, [
      //    'game_id' => 'required',
      //    'user_id' => 'required',
      //    'score' => 'required|integer|max:180',
      //    'remainingScore*' => 'required',
      // ],
      // [
      //    'user_id.required' => 'Please select a player.',
      //    'score.required' => 'Please enter a score.',
      //    'score.integer' => 'Score must be a number.',
      //    'score.max' => 'Score must be 180 or less.'
      // ]);

      // dd($request->all());
      $data = $request->all();

      // if($data->contains('p2'))
      // {
      //    echo "P2";
      // }

if(array_key_exists('p2', $data))
{
   echo "HERE";
   foreach(p2 as $p)
   {
      echo $p;
   }
} else {
   echo "NOT";
}

// if (in_array("p2", $data)) {
//     echo "Present";
// } else {
//    echo "Not there";
// }

//       echo $gameID = $request->gameID;

      

// if (array_key_exists("p7_i3", $request->all()))
// {
// echo "Key exists!";
// echo "<br />";
// echo $request->p7_i3;
// }
// else
// {
// echo "Key does not exist!";
// }


$array = $request->all();

for ($x = 1; $x <= 9; $x++)
{
   // echo $x;
   $p[$x] = array_filter(
       $array,
       function ($key){ 
           return(strpos($key,'p[$x]_') !== false);
       }, 
       ARRAY_FILTER_USE_KEY
   );

}


// // the array you'll search in
// // $array = ["search_1"=>"value1","search_2"=>"value2","not_search"=>"value3"];
// $array = $request->all();
// // filter the array and assign the returned array to variable
// $p1 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p1_') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p1);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p2 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p2_') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p2);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p3 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p3_') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p3);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p4 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p4') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p4);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p5 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p5') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p5);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p6 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p6') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p6);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p7 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p7') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p7);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p8 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p8') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p8);
// echo "<br />"; 

// // filter the array and assign the returned array to variable
// $p9 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p9') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p9);
// echo "<br />";

// // filter the array and assign the returned array to variable
// $p10 = array_filter(
//     // the array you wanna search in
//     $array, 
//     // callback function to search for certain sting
//     function ($key){ 
//         return(strpos($key,'p10') !== false);
//     }, 
//     // flag to let the array_filter(); know that you deal with array keys
//     ARRAY_FILTER_USE_KEY
// );
// // print out the returned array
// print_r($p10);
// echo "<br />";





     // Session::flash('dart-success','The game as been marked as completed.');
      // return redirect()->back();
   }


##################################################################################################################
#  ██████╗ ██████╗ ███╗   ███╗██████╗ ██╗     ███████╗████████╗███████╗
# ██╔════╝██╔═══██╗████╗ ████║██╔══██╗██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║     ██║   ██║██╔████╔██║██████╔╝██║     █████╗     ██║   █████╗  
# ██║     ██║   ██║██║╚██╔╝██║██╔═══╝ ██║     ██╔══╝     ██║   ██╔══╝  
# ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║     ███████╗███████╗   ██║   ███████╗
#  ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚══════╝╚══════╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function completed($id)
   {
      // Change the game status to Completed
      $game = Game::find($id);
         $game->status = 'Completed';
      $game->save();

      Session::flash('dart-success','The game as been marked as completed.');
      return redirect()->route('darts.games.board');
   }
}
