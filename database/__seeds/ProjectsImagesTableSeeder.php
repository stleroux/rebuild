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
                'id' => 8,
                'project_id' => 3,
                'name' => '1562724890.jpg',
                'description' => 'Main image',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-09 22:14:50',
                'updated_at' => '2019-07-09 22:14:50',
            ),
            1 => 
            array (
                'id' => 9,
                'project_id' => 3,
                'name' => '1562636684.png',
                'description' => '',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 1,
                'created_at' => '2019-07-08 21:44:44',
                'updated_at' => '2019-07-08 21:44:44',
            ),
            2 => 
            array (
                'id' => 10,
                'project_id' => 3,
                'name' => '1562636699.png',
                'description' => '',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-08 21:44:59',
                'updated_at' => '2019-07-08 21:44:59',
            ),
            3 => 
            array (
                'id' => 11,
                'project_id' => 6,
                'name' => '1562837814.jpg',
                'description' => 'First ever candle box',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-11 05:36:54',
                'updated_at' => '2019-07-11 05:36:54',
            ),
            4 => 
            array (
                'id' => 12,
                'project_id' => 7,
                'name' => '1562886825.jpg',
                'description' => 'Main image',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-11 19:13:46',
                'updated_at' => '2019-07-11 19:13:46',
            ),
            5 => 
            array (
                'id' => 13,
                'project_id' => 8,
                'name' => '1562893197.jpg',
                'description' => 'Wine rack made of white pine',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-11 20:59:57',
                'updated_at' => '2019-07-11 20:59:57',
            ),
            6 => 
            array (
                'id' => 14,
                'project_id' => 9,
                'name' => '1562894287.jpg',
                'description' => 'MIrror',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-11 21:18:07',
                'updated_at' => '2019-07-11 21:18:07',
            ),
            7 => 
            array (
                'id' => 15,
                'project_id' => 10,
                'name' => '1563285704.jpg',
                'description' => 'qwerty',
                'mine_type' => '',
                'size' => 0,
                'path' => '',
                'main_image' => 0,
                'created_at' => '2019-07-16 10:01:44',
                'updated_at' => '2019-07-16 10:01:44',
            ),
        ));
        
        
    }
}