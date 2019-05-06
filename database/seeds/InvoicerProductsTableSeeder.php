<?php

namespace Modules\Invoicer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InvoicerProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer_products')->delete();
        
        \DB::table('invoicer_products')->insert(array (
            0 => 
            array (
                'code' => 'H/W',
                'created_at' => '2018-10-30 16:40:56',
                'details' => 'Hardware',
                'id' => 1,
                'updated_at' => '2018-10-30 16:40:56',
            ),
            1 => 
            array (
                'code' => 'Labour',
                'created_at' => '2018-10-30 16:41:39',
                'details' => 'Hourly labour rate',
                'id' => 2,
                'updated_at' => '2018-10-30 16:41:39',
            ),
            2 => 
            array (
                'code' => 'Trim',
                'created_at' => '2018-10-30 16:41:52',
                'details' => 'Trim',
                'id' => 3,
                'updated_at' => '2018-10-30 16:41:52',
            ),
        ));
        
        
    }
}