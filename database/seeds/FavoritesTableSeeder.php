<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('favorites')->delete();
        
        \DB::table('favorites')->insert(array (
            0 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'App\\Models\\Articles\\Article',
                'favoriteable_id' => 4,
                'created_at' => '2019-10-27 05:15:01',
                'updated_at' => '2019-10-27 05:15:01',
            ),
            1 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'App\\Models\\Articles\\Article',
                'favoriteable_id' => 7,
                'created_at' => '2019-10-25 21:43:47',
                'updated_at' => '2019-10-25 21:43:47',
            ),
            2 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 14,
                'created_at' => '2019-01-29 21:54:59',
                'updated_at' => '2019-01-29 21:54:59',
            ),
            3 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 26,
                'created_at' => '2019-01-29 19:10:13',
                'updated_at' => '2019-01-29 19:10:13',
            ),
            4 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'App\\Models\\Recipes\\Recipe',
                'favoriteable_id' => 27,
                'created_at' => '2019-11-15 08:58:42',
                'updated_at' => '2019-11-15 08:58:42',
            ),
            5 => 
            array (
                'user_id' => 3,
                'favoriteable_type' => 'App\\Models\\Recipes\\Recipe',
                'favoriteable_id' => 26,
                'created_at' => '2019-09-17 09:03:37',
                'updated_at' => '2019-09-17 09:03:37',
            ),
        ));
        
        
    }
}