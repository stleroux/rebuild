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
                'permission_id' => 47,
                'user_id' => 3,
            ),
            4 => 
            array (
                'permission_id' => 52,
                'user_id' => 3,
            ),
            5 => 
            array (
                'permission_id' => 65,
                'user_id' => 3,
            ),
        ));
        
        
    }
}