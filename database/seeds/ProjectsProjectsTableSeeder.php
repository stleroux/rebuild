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
                'views' => 94,
                'time_invested' => NULL,
                'price' => 30,
                'width' => 25,
                'depth' => 50,
                'height' => 75,
                'weight' => 100,
                'completed_at' => '2019-07-10 18:25:00',
                'created_at' => '2019-06-30 15:18:41',
                'updated_at' => '2019-07-10 18:31:07',
            ),
            1 => 
            array (
                'id' => 6,
                'category' => 1,
                'name' => 'Candle Box',
                'description' => 'General project description',
                'views' => 26,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-07 15:07:28',
                'updated_at' => '2019-07-11 20:44:10',
            ),
            2 => 
            array (
                'id' => 7,
                'category' => 1,
                'name' => 'Chalkboard',
                'description' => 'Small chalkboard',
                'views' => 25,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-11 19:13:19',
                'updated_at' => '2019-07-11 19:13:19',
            ),
            3 => 
            array (
                'id' => 8,
                'category' => 3,
                'name' => 'Testing',
                'description' => 'Blah Blah Blah',
                'views' => 7,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-11 20:51:24',
                'updated_at' => '2019-07-15 19:45:01',
            ),
            4 => 
            array (
                'id' => 9,
                'category' => 2,
                'name' => 'Antique mirror',
                'description' => 'From an old window',
                'views' => 21,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-11 21:17:01',
                'updated_at' => '2019-07-11 21:17:01',
            ),
        ));
        
        
    }
}