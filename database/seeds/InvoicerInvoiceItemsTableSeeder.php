<?php

use Illuminate\Database\Seeder;

class InvoicerInvoiceItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer__invoice_items')->delete();
        
        \DB::table('invoicer__invoice_items')->insert(array (
            0 => 
            array (
                'id' => 2,
                'invoice_id' => 2,
                'product_id' => 2,
                'notes' => NULL,
                'quantity' => 2.0,
                'price' => '35.00',
                'total' => '70.00',
                'work_date' => '2018-10-11 00:00:00',
                'created_at' => '2018-10-30 16:54:23',
                'updated_at' => '2018-10-30 16:54:23',
            ),
            1 => 
            array (
                'id' => 3,
                'invoice_id' => 3,
                'product_id' => 1,
                'notes' => NULL,
                'quantity' => 1.0,
                'price' => '450.00',
                'total' => '450.00',
                'work_date' => '2019-05-13 00:00:00',
                'created_at' => '2019-05-13 14:19:13',
                'updated_at' => '2019-05-13 14:25:14',
            ),
            2 => 
            array (
                'id' => 4,
                'invoice_id' => 3,
                'product_id' => 2,
                'notes' => NULL,
                'quantity' => 2.0,
                'price' => '45.00',
                'total' => '90.00',
                'work_date' => '2019-05-13 00:00:00',
                'created_at' => '2019-05-13 14:20:04',
                'updated_at' => '2019-05-13 14:25:18',
            ),
            3 => 
            array (
                'id' => 5,
                'invoice_id' => 4,
                'product_id' => 3,
                'notes' => NULL,
                'quantity' => 1.0,
                'price' => '450.00',
                'total' => '450.00',
                'work_date' => '2019-05-13 00:00:00',
                'created_at' => '2019-05-13 14:26:38',
                'updated_at' => '2019-05-13 14:26:38',
            ),
            4 => 
            array (
                'id' => 6,
                'invoice_id' => 5,
                'product_id' => 4,
                'notes' => NULL,
                'quantity' => 1.0,
                'price' => '123.00',
                'total' => '123.00',
                'work_date' => '2019-07-18 00:00:00',
                'created_at' => '2019-07-16 09:58:17',
                'updated_at' => '2019-07-16 09:58:17',
            ),
        ));
        
        
    }
}