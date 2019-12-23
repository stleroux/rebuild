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
        

        \DB::table('projects__projects')->delete();
        
        \DB::table('projects__projects')->insert(array (
            0 => 
            array (
                'id' => 11,
                'category' => 2,
                'name' => 'Hallway table',
                'description' => 'Nice hallway table with ceramic tile top',
                'views' => 95,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-21 22:12:18',
                'updated_at' => '2019-07-21 22:12:18',
            ),
            1 => 
            array (
                'id' => 12,
                'category' => 2,
                'name' => 'Storage Bench',
                'description' => 'Storage Bench',
                'views' => 70,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-22 16:42:54',
                'updated_at' => '2019-07-22 16:42:54',
            ),
            2 => 
            array (
                'id' => 13,
                'category' => 5,
                'name' => 'Chalkboard',
                'description' => 'Small chalkboard',
                'views' => 29,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-22 16:43:42',
                'updated_at' => '2019-07-22 16:43:42',
            ),
            3 => 
            array (
                'id' => 14,
                'category' => 1,
                'name' => 'Candle Box',
                'description' => 'Candle box',
                'views' => 87,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-22 16:44:44',
                'updated_at' => '2019-07-28 20:40:07',
            ),
            4 => 
            array (
                'id' => 15,
                'category' => 1,
                'name' => 'Candle Holder',
                'description' => 'Candle Holder',
                'views' => 86,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-22 16:44:59',
                'updated_at' => '2019-07-28 20:40:30',
            ),
            5 => 
            array (
                'id' => 18,
                'category' => 5,
                'name' => 'Corner Shelf',
                'description' => 'Corner Shelf',
                'views' => 50,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-26 06:28:32',
                'updated_at' => '2019-07-26 06:30:53',
            ),
            6 => 
            array (
                'id' => 19,
                'category' => 5,
                'name' => 'Antique mirror',
                'description' => 'Antique mirror',
                'views' => 132,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-26 06:28:56',
                'updated_at' => '2019-07-26 06:28:56',
            ),
            7 => 
            array (
                'id' => 20,
                'category' => 5,
                'name' => 'Wine Rack',
                'description' => 'Wine Rack',
                'views' => 49,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-07-26 06:29:12',
                'updated_at' => '2019-07-26 06:29:12',
            ),
            8 => 
            array (
                'id' => 21,
                'category' => 1,
                'name' => '_dsdsd',
                'description' => 'sdsdsdsd',
                'views' => 1,
                'time_invested' => NULL,
                'price' => NULL,
                'width' => NULL,
                'depth' => NULL,
                'height' => NULL,
                'weight' => NULL,
                'completed_at' => NULL,
                'created_at' => '2019-09-27 15:45:11',
                'updated_at' => '2019-09-27 15:45:11',
            ),
        ));
        
        
    }
}