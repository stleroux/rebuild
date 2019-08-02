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
                'favoriteable_type' => 'App\\Models\\Recipes\\Recipe',
                'favoriteable_id' => 4,
                'created_at' => '2019-05-28 15:23:07',
                'updated_at' => '2019-05-28 15:23:07',
            ),
            1 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 14,
                'created_at' => '2019-01-29 21:54:59',
                'updated_at' => '2019-01-29 21:54:59',
            ),
            2 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 26,
                'created_at' => '2019-01-29 19:10:13',
                'updated_at' => '2019-01-29 19:10:13',
            ),
            3 => 
            array (
                'user_id' => 2,
                'favoriteable_type' => 'App\\Models\\Recipes\\Recipe',
                'favoriteable_id' => 27,
                'created_at' => '2019-05-28 12:58:56',
                'updated_at' => '2019-05-28 12:58:56',
            ),
        ));
        
        
    }
}