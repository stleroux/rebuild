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
        

        \DB::table('invoicer__clients')->delete();
        
        \DB::table('invoicer__clients')->insert(array (
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
                'email' => 'test2@hotmail.com',
                'website' => NULL,
                'notes' => NULL,
                'created_at' => '2018-10-30 16:45:03',
                'updated_at' => '2019-07-25 23:38:10',
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
            3 => 
            array (
                'id' => 4,
                'company_name' => 'sdasdasd',
                'contact_name' => 'asdasdasd',
                'address' => NULL,
                'city' => NULL,
                'state' => NULL,
                'zip' => NULL,
                'telephone' => '3412231232',
                'cell' => NULL,
                'fax' => NULL,
                'email' => 'asdasd@dsdsd.com',
                'website' => NULL,
                'notes' => NULL,
                'created_at' => '2019-07-16 09:57:10',
                'updated_at' => '2019-07-16 09:57:18',
            ),
            4 => 
            array (
                'id' => 5,
                'company_name' => 'test',
                'contact_name' => 'Stacie Haynes',
                'address' => NULL,
                'city' => NULL,
                'state' => NULL,
                'zip' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'email' => 'test123@test.com',
                'website' => NULL,
                'notes' => NULL,
                'created_at' => '2019-07-25 23:28:07',
                'updated_at' => '2019-07-25 23:38:26',
            ),
        ));
        
        
    }
}