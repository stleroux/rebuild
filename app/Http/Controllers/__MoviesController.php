<?php

namespace App\Http\Controllers;

// use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Carbon\Carbon;
use Auth;
use DB;
use File;
use Log;
use Redirect;
use Session;

// use App\Http\Requests\CreateCommentRequest;

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
   public function __construct() {
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





	public function import() {

		foreach (File::allFiles(storage_path('json')) as $filename) {

			$data = file_get_contents($filename);

			$array = json_decode($data, true);

			foreach($array as $row)
			{
				$movie = new Movie;
					$movie->col_no = $row["CollectionNumber"];
					$movie->title = $row["Title"];
					if($row["OriginalTitle"]) { $movie->original_title = $row["OriginalTitle"]; }
					if($row["UPC"]) { $movie->upc	= $row["UPC"]; }
					if($row["RunningTime"]) { $movie->running_time = $row["RunningTime"]; }
					if($row["Rating"]) { $movie->rating = $row["Rating"]; }
					// if($row["Genres"]) { $movie->genres = $row["Genres"]; }
					// if($row["Studios"]) { $movie->studios	= $row["Studios"]; }
					if($row["Overview"]) { $movie->overview = $row["Overview"]; }
					if($row["ProductionYear"]) { $movie->production_year	= $row["ProductionYear"]; }
					$movie->intID = $row["ID"];
				$movie->save();
			}

			echo $filename . " processed successfully<br />";
		}

		echo "Data should be inserted";
	}

}
