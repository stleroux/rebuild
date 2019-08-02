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
        

        \DB::table('projects__material_project')->delete();
        
        \DB::table('projects__material_project')->insert(array (
            0 => 
            array (
                'id' => 11,
                'project_id' => 11,
                'material_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}