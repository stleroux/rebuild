<?php

namespace Modules\Invoicer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
                'address' => '1216 Ste Marie Rd',
                'cell' => '613-402-0275',
                'city' => 'Embrun',
                'company_name' => 'TheWoodBarn.ca',
                'contact_name' => 'Stephane Leroux',
                'created_at' => '2018-10-30 16:44:04',
                'email' => 'stleroux@hotmaill.ca',
                'fax' => NULL,
                'id' => 1,
                'notes' => NULL,
                'state' => 'On',
                'telephone' => '613-370-0275',
                'updated_at' => '2018-10-30 16:44:04',
                'website' => 'thewoodbarn.ca',
                'zip' => 'K0A 1W0',
            ),
            1 => 
            array (
                'address' => '1000 Notre-Dame Street',
                'cell' => '613 456 4566',
                'city' => 'Embrun',
                'company_name' => 'Dan Trim',
                'contact_name' => 'Dan Menard',
                'created_at' => '2018-10-30 16:45:03',
                'email' => NULL,
                'fax' => NULL,
                'id' => 2,
                'notes' => NULL,
                'state' => 'On',
                'telephone' => '613 123 4567',
                'updated_at' => '2018-10-30 16:45:03',
                'website' => NULL,
                'zip' => 'K0A 1W0',
            ),
            2 => 
            array (
                'address' => '200 Kent Street',
                'cell' => NULL,
                'city' => 'Ottawa',
                'company_name' => 'DFO',
                'contact_name' => 'Julien Tremblay',
                'created_at' => '2018-10-31 16:23:24',
                'email' => NULL,
                'fax' => NULL,
                'id' => 3,
                'notes' => NULL,
                'state' => 'On',
                'telephone' => '613-444-7878',
                'updated_at' => '2018-10-31 16:23:24',
                'website' => NULL,
                'zip' => 'K1E 2F8',
            ),
        ));
        
        
    }
}