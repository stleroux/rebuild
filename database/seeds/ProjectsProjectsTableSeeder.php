<?php

use Illuminate\Database\Seeder;

class ProjectsProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects-projects')->delete();
        
        \DB::table('projects-projects')->insert(array (
            0 => 
            array (
                'id' => 3,
                'category' => 2,
                'name' => 'Hallway table',
                'description' => 'Slender and elegant hallway table with ceramic tile top',
                'views' => 0,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => 25,
                'depth' => 50,
                'height' => 75,
                'weight' => 100,
                'completed_at' => NULL,
                'created_at' => '2019-06-30 15:18:41',
                'updated_at' => '2019-06-30 18:13:04',
            ),
            1 => 
            array (
                'id' => 4,
                'category' => 1,
                'name' => 'Storage chest',
                'description' => 'Store all kinds of goodies in here',
                'views' => 0,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-06-30 17:55:36',
                'updated_at' => '2019-06-30 18:02:21',
            ),
        ));
        
        
    }
}