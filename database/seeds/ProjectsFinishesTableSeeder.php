<?php

use Illuminate\Database\Seeder;

class ProjectsFinishesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects-finishes')->delete();
        
        \DB::table('projects-finishes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Polyurethane',
                'type' => '',
                'color_name' => '',
                'color_code' => '',
                'sheen' => '1',
                'manufacturer' => '',
                'upc' => '',
                'notes' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Varnish',
                'type' => '',
                'color_name' => '',
                'color_code' => '',
                'sheen' => '3',
                'manufacturer' => '',
                'upc' => '',
                'notes' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Shellac',
                'type' => '',
                'color_name' => '',
                'color_code' => '',
                'sheen' => '4',
                'manufacturer' => '',
                'upc' => '',
                'notes' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}