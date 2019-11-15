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
        

        \DB::table('projects__finish_project')->delete();
        
        \DB::table('projects__finish_project')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 14,
                'finish_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}