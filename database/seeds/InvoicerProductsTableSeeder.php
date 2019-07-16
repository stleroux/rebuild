<?php

use Illuminate\Database\Seeder;

class InvoicerProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer__products')->delete();
        
        \DB::table('invoicer__products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'H/W',
                'details' => 'Hardware',
                'created_at' => '2018-10-30 16:40:56',
                'updated_at' => '2018-10-30 16:40:56',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'Labour',
                'details' => 'Hourly labour rate',
                'created_at' => '2018-10-30 16:41:39',
                'updated_at' => '2018-10-30 16:41:39',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'Trim',
                'details' => 'Trim',
                'created_at' => '2018-10-30 16:41:52',
                'updated_at' => '2018-10-30 16:41:52',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'sdsad',
                'details' => 'sadasdasdasdasd',
                'created_at' => '2019-07-16 09:54:01',
                'updated_at' => '2019-07-16 09:54:01',
            ),
        ));
        
        
    }
}