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
        

        \DB::table('projects-materials')->delete();
        
        \DB::table('projects-materials')->insert(array (
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
        ));
        
        
    }
}