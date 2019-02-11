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
                'user_id' => 1,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 2,
                'created_at' => '2019-02-01 17:25:25',
                'updated_at' => '2019-02-01 17:25:25',
            ),
            1 => 
            array (
                'user_id' => 1,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 14,
                'created_at' => '2019-01-29 21:54:59',
                'updated_at' => '2019-01-29 21:54:59',
            ),
            2 => 
            array (
                'user_id' => 1,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 15,
                'created_at' => '2019-01-29 21:55:18',
                'updated_at' => '2019-01-29 21:55:18',
            ),
            3 => 
            array (
                'user_id' => 1,
                'favoriteable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'favoriteable_id' => 26,
                'created_at' => '2019-01-29 19:10:13',
                'updated_at' => '2019-01-29 19:10:13',
            ),
        ));
        
        
    }
}