<?php

namespace Modules\Recipes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RecipeUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recipe_user')->delete();
        
        \DB::table('recipe_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'recipe_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}