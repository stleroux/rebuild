<?php

use Illuminate\Database\Seeder;
// use DB;

class MoviesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('movies')->delete();
        
        \DB::table('movies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'title' => 'First test',
                'email' => 'first@test.com',
                'category' => 1,
                'views' => 10,
                'published_at' => '2019-11-04 12:23:35',
                'deleted_at' => NULL,
                'created_at' => '2019-11-04 12:23:35',
                'updated_at' => '2019-11-04 12:23:35',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'title' => 'Second test',
                'email' => 'second@test.com',
                'category' => 2,
                'views' => 10,
                'published_at' => '2019-11-04 12:23:58',
                'deleted_at' => NULL,
                'created_at' => '2019-11-04 12:23:58',
                'updated_at' => '2019-11-04 12:23:58',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 3,
                'title' => 'Third test',
                'email' => 'third@test.com',
                'category' => 3,
                'views' => 0,
                'published_at' => '2019-12-04 12:24:19',
                'deleted_at' => NULL,
                'created_at' => '2019-11-04 12:24:19',
                'updated_at' => '2019-11-04 12:24:19',
            ),
        ));
        
        
    }
}