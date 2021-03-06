<?php

use Illuminate\Database\Seeder;

class ProjectsMaterialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects__materials')->delete();
        
        \DB::table('projects__materials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Ash',
                'type' => '',
                'notes' => '',
                'manufacturer' => '',
                'UPC' => '',
                'created_at' => '2019-06-30 05:16:22',
                'updated_at' => '2019-06-30 05:16:22',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Oak',
                'type' => '',
                'notes' => '',
                'manufacturer' => '',
                'UPC' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Maple',
                'type' => '',
                'notes' => '',
                'manufacturer' => '',
                'UPC' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Curly Maple',
                'type' => 'Hardwood',
                'notes' => 'No notes for this product again',
                'manufacturer' => 'ABC Company',
                'UPC' => '123123123123',
                'created_at' => '2019-07-06 21:00:05',
                'updated_at' => '2019-07-06 21:16:33',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Zebra Wood',
                'type' => 'Fucked up wood',
                'notes' => 'I don\'t give a crap',
                'manufacturer' => 'NA',
                'UPC' => 'NA',
                'created_at' => '2019-07-11 21:04:29',
                'updated_at' => '2019-07-11 21:04:29',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => '_test',
                'type' => 'qqqq',
                'notes' => ';ldkf d;lkfd;lkf d;lskf;dslkfd;l fkl;dsfk d;slkf',
                'manufacturer' => 'wwww',
                'UPC' => 'eeee',
                'created_at' => '2019-10-08 19:32:07',
                'updated_at' => '2019-10-08 19:32:07',
            ),
        ));
        
        
    }
}