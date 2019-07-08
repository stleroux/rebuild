<?php

use Illuminate\Database\Seeder;

class ProjectsMaterialProjectTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects-material_project')->delete();
        
        \DB::table('projects-material_project')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 4,
                'material_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'project_id' => 4,
                'material_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}