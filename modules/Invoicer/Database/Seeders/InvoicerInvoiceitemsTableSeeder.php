<?php

namespace Modules\Invoicer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InvoicerInvoiceitemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer_invoiceitems')->delete();
        
        \DB::table('invoicer_invoiceitems')->insert(array (
            0 => 
            array (
                'created_at' => '2018-10-30 16:54:23',
                'id' => 2,
                'invoice_id' => 2,
                'notes' => NULL,
                'price' => '35.00',
                'product_id' => 2,
                'quantity' => 2.0,
                'total' => '70.00',
                'updated_at' => '2018-10-30 16:54:23',
                'work_date' => '2018-10-11 00:00:00',
            ),
        ));
        
        
    }
}