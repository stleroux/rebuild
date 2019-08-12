<?php

use Illuminate\Database\Seeder;

class ProjectsImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects__images')->delete();
        
        \DB::table('projects__images')->insert(array (
            0 => 
            array (
                'id' => 41,
                'project_id' => 11,
                'name' => '1563828133.jpg',
                'description' => 'Hallway table',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-22 16:42:14',
                'updated_at' => '2019-07-22 16:42:14',
            ),
            1 => 
            array (
                'id' => 42,
                'project_id' => 12,
                'name' => '1563828189.jpg',
                'description' => 'Bench',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-22 16:43:09',
                'updated_at' => '2019-07-22 16:43:09',
            ),
            2 => 
            array (
                'id' => 43,
                'project_id' => 13,
                'name' => '1563828237.jpg',
                'description' => 'Small chalkboard',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-22 16:43:58',
                'updated_at' => '2019-07-22 16:43:58',
            ),
            3 => 
            array (
                'id' => 44,
                'project_id' => 14,
                'name' => '1563828315.jpg',
                'description' => 'Candle box',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-22 16:45:15',
                'updated_at' => '2019-07-22 16:45:15',
            ),
            4 => 
            array (
                'id' => 45,
                'project_id' => 15,
                'name' => '1563828333.jpg',
                'description' => 'Candle Holder 1',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-22 16:45:33',
                'updated_at' => '2019-07-22 16:45:33',
            ),
            5 => 
            array (
                'id' => 47,
                'project_id' => 19,
                'name' => '1564136980.jpg',
                'description' => 'Antique mirror',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-26 06:29:40',
                'updated_at' => '2019-07-26 06:29:40',
            ),
            6 => 
            array (
                'id' => 49,
                'project_id' => 18,
                'name' => '1564137045.jpg',
                'description' => 'Corner Shelf',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-26 06:30:45',
                'updated_at' => '2019-07-26 06:30:45',
            ),
            7 => 
            array (
                'id' => 50,
                'project_id' => 20,
                'name' => '1564137068.jpg',
                'description' => 'Wine Rack',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-26 06:31:09',
                'updated_at' => '2019-07-26 06:31:09',
            ),
            8 => 
            array (
                'id' => 51,
                'project_id' => 14,
                'name' => '1564360784.jpg',
                'description' => 'Picture #2',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-28 20:39:45',
                'updated_at' => '2019-07-28 20:39:45',
            ),
            9 => 
            array (
                'id' => 52,
                'project_id' => 15,
                'name' => '1564360848.jpg',
                'description' => 'Picture #2',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-28 20:40:48',
                'updated_at' => '2019-07-28 20:40:48',
            ),
        ));
        
        
    }
}