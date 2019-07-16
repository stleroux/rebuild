<?php

use Illuminate\Database\Seeder;

class InvoicerInvoicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer__invoices')->delete();
        
        \DB::table('invoicer__invoices')->insert(array (
            0 => 
            array (
                'id' => 2,
                'client_id' => 2,
                'notes' => NULL,
                'status' => 'paid',
                'amount_charged' => '70.00',
                'hst' => '9.10',
                'sub_total' => '79.10',
                'wsib' => '4.20',
                'income_taxes' => '18.20',
                'total_deductions' => '22.40',
                'total' => '47.60',
                'invoiced_at' => '2019-06-19 09:19:58',
                'paid_at' => '2019-06-19 09:20:11',
                'created_at' => '2018-10-30 16:54:06',
                'updated_at' => '2019-06-19 09:20:11',
            ),
            1 => 
            array (
                'id' => 3,
                'client_id' => 3,
                'notes' => NULL,
                'status' => 'logged',
                'amount_charged' => '540.00',
                'hst' => '70.20',
                'sub_total' => '610.20',
                'wsib' => '64.80',
                'income_taxes' => '140.40',
                'total_deductions' => '205.20',
                'total' => '334.80',
                'invoiced_at' => NULL,
                'paid_at' => NULL,
                'created_at' => '2019-05-13 14:18:53',
                'updated_at' => '2019-05-13 14:25:19',
            ),
            2 => 
            array (
                'id' => 4,
                'client_id' => 1,
                'notes' => NULL,
                'status' => 'invoiced',
                'amount_charged' => '450.00',
                'hst' => '58.50',
                'sub_total' => '508.50',
                'wsib' => '54.00',
                'income_taxes' => '117.00',
                'total_deductions' => '171.00',
                'total' => '279.00',
                'invoiced_at' => '2019-06-17 13:44:53',
                'paid_at' => NULL,
                'created_at' => '2019-05-13 14:26:17',
                'updated_at' => '2019-06-17 13:44:53',
            ),
            3 => 
            array (
                'id' => 5,
                'client_id' => 4,
                'notes' => NULL,
                'status' => 'logged',
                'amount_charged' => '123.00',
                'hst' => '15.99',
                'sub_total' => '138.99',
                'wsib' => '14.76',
                'income_taxes' => '31.98',
                'total_deductions' => '46.74',
                'total' => '76.26',
                'invoiced_at' => NULL,
                'paid_at' => NULL,
                'created_at' => '2019-07-16 09:57:47',
                'updated_at' => '2019-07-16 09:58:17',
            ),
        ));
        
        
    }
}