<?php

namespace App\Models\Invoicer;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model {

   public function totalAmountCharged()
   {
      // $totalAmountCharged = DB::table('invoicer__invoices')->sum('amount_charged');
   }

}
