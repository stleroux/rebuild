<?php

use Illuminate\Database\Seeder;

class PermissionUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permission_user')->delete();
        
        \DB::table('permission_user')->insert(array (
            0 => 
            array (
                'permission_id' => 53,
                'user_id' => 8,
            ),
            1 => 
            array (
                'permission_id' => 52,
                'user_id' => 8,
            ),
            2 => 
            array (
                'permission_id' => 56,
                'user_id' => 8,
            ),
            3 => 
            array (
                'permission_id' => 203,
                'user_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 200,
                'user_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 204,
                'user_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 202,
                'user_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 201,
                'user_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 203,
                'user_id' => 3,
            ),
            9 => 
            array (
                'permission_id' => 200,
                'user_id' => 3,
            ),
            10 => 
            array (
                'permission_id' => 204,
                'user_id' => 3,
            ),
        ));
        
        
    }
}