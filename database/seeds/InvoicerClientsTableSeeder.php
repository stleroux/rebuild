<?php

use Illuminate\Database\Seeder;

class InvoicerClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoicer_clients')->delete();
        
        \DB::table('invoicer_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_name' => 'TheWoodBarn.ca',
                'contact_name' => 'Stephane Leroux',
                'address' => '1216 Ste Marie Rd',
                'city' => 'Embrun',
                'state' => 'On',
                'zip' => 'K0A 1W0',
                'telephone' => '613-370-0275',
                'cell' => '613-402-0275',
                'fax' => NULL,
                'email' => 'stleroux@hotmaill.ca',
                'website' => 'thewoodbarn.ca',
                'notes' => NULL,
                'created_at' => '2018-10-30 16:44:04',
                'updated_at' => '2018-10-30 16:44:04',
            ),
            1 => 
            array (
                'id' => 2,
                'company_name' => 'Dan Trim',
                'contact_name' => 'Dan Menard',
                'address' => '1000 Notre-Dame Street',
                'city' => 'Embrun',
                'state' => 'On',
                'zip' => 'K0A 1W0',
                'telephone' => '613 123 4567',
                'cell' => '613 456 4566',
                'fax' => NULL,
                'email' => NULL,
                'website' => NULL,
                'notes' => NULL,
                'created_at' => '2018-10-30 16:45:03',
                'updated_at' => '2018-10-30 16:45:03',
            ),
            2 => 
            array (
                'id' => 3,
                'company_name' => 'DFO',
                'contact_name' => 'Julien Tremblay',
                'address' => '200 Kent Street',
                'city' => 'Ottawa',
                'state' => 'On',
                'zip' => 'K1E 2F8',
                'telephone' => '613-444-7878',
                'cell' => NULL,
                'fax' => NULL,
                'email' => NULL,
                'website' => NULL,
                'notes' => NULL,
                'created_at' => '2018-10-31 16:23:24',
                'updated_at' => '2018-10-31 16:23:24',
            ),
        ));
        
        
    }
}