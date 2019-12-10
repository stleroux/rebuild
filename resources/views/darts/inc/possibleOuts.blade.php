<?php
      if($user->dart_doubleOut){
         $finaldart = $user->dart_doubleOut * 2;
      } else {
         $finaldart = 20 * 2;
      }

      if ($score > 170 || $score <= 1 ) {
         echo '<div class="card mb-1 bg-danger">
               <div class="card-header p-1 bg-secondary">No Outs Possible</div>
               </div>';
      } else {
         for ($firstdart=60; $firstdart >= 0; $firstdart--) {
            if (
               $firstdart <= 20 || 
               $firstdart == 50 || 
               $firstdart == 25 || 
               ($firstdart % 3 == 0) || 
               ($firstdart <= 40 && $firstdart % 2 == 0)
            ) {
               /*
               if it is less than 20 or equal to, because 20 - 1 on board, 
               if it is less than or equal to 40 and divisible by 2 because it could be a double
               if it is divisible by 3 because it could be a triple
               if it is a double or single bull, no point in checking the double for 60-51 
               */
               for ($seconddart=60; $seconddart >= 0; $seconddart--) {
                  if (
                     $seconddart <= 20 || 
                     $seconddart == 50 || 
                     $seconddart == 25 || 
                     ($seconddart % 3 == 0) || 
                     ($seconddart <= 40 && $seconddart % 2 == 0)
                     ) {
                     for ($thirddart=50; $thirddart > 0; $thirddart = $thirddart - 2) {
                        if ($thirddart == 48) {
                           $thirddart = 40;
                        }
                        $outstring = 'Double ' . ($thirddart / 2);
                        if (($thirddart + $seconddart + $firstdart) == $score && (@!in_array($seconddart . ', ' . $firstdart . ', ' . $outstring . "<br />\n", $pouts) && @!in_array($seconddart . ', ' . $firstdart . ', ' . $outstring . "<br />\n", $everyotherout))) {
                           if ($thirddart == $finaldart) {
                              $pouts[] = $firstdart . ', ' . $seconddart . ', ' . $outstring . "<br />\n";
                           } else {
                              $everyotherout[] = $firstdart . ', ' . $seconddart . ', ' . $outstring . "<br />\n";
                           }
                        }
                     }
                  }
               }
            }
         }

      if(!empty($finaldart)) {
         if(!empty($pouts)){
            echo '
               <div class="card mb-1">
                  <div class="card-header p-1">
                     Preferred Outs
                  </div>
                  <table class="table table-hover table-sm">
            ';
            foreach($pouts as $out) {
               echo '<tr class="text-light"><td>'.$out.'</td></tr>';
            }
            echo '</table></div>';
            
         } else { 
            echo '<div class="card mb-1 bg-danger">
                  <div class="card-header p-1 bg-secondary">
                     No Preferred Outs Available
                  </div></div>
                  ';
         }
      }

      if(!empty($everyotherout)) {
         echo '<div class="card mb-1">
               <div class="card-header p-1">
                  Every Other Out
               </div>
               <table class="table table-hover table-sm">';
                  foreach($everyotherout as $out) {
                     echo '<tr class="text-light"><td>'.$out.'</td></tr>';
                  }
      } else if(empty($pouts)){
         echo '<div class="card mb-1">
               <div class="card-header p-1">
                  Every Other Out
               </div>
               <table class="table table-hover table-sm">';
         echo '<tr><td class="text-danger">No outs available.</td></tr>';
      }
      }
      echo '</table></div>';
   