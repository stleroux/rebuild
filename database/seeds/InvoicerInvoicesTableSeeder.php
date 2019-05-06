<?php

namespace Modules\Invoicer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InvoicerInvoicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer_invoices')->delete();
        
        \DB::table('invoicer_invoices')->insert(array (
            0 => 
            array (
                'amount_charged' => '70.00',
                'client_id' => 2,
                'created_at' => '2018-10-30 16:54:06',
                'hst' => '9.10',
                'id' => 2,
                'income_taxes' => '18.20',
                'invoiced_at' => NULL,
                'notes' => NULL,
                'paid_at' => NULL,
                'status' => 'logged',
                'sub_total' => '79.10',
                'total' => '47.60',
                'total_deductions' => '22.40',
                'updated_at' => '2018-10-30 16:54:23',
                'wsib' => '4.20',
            ),
        ));
        
        
    }
}