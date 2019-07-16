<?php

use Illuminate\Database\Seeder;

class ProjectsFinishProjectTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects-finish_project')->delete();
        
        \DB::table('projects-finish_project')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 3,
                'finish_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'project_id' => 8,
                'finish_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'project_id' => 8,
                'finish_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'project_id' => 8,
                'finish_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}