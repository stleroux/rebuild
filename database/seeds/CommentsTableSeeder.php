<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'comment' => 'dsds',
                'approved' => 0,
                'commentable_type' => 'App\\Post',
                'commentable_id' => 1,
                'created_at' => '2019-01-27 07:50:08',
                'updated_at' => '2019-01-27 07:50:08',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'comment' => 'dsds',
                'approved' => 0,
                'commentable_type' => 'App\\Recipe',
                'commentable_id' => 2,
                'created_at' => '2019-01-27 08:07:33',
                'updated_at' => '2019-01-27 08:07:33',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'comment' => 'fsdfsdfsdfsdf',
                'approved' => 0,
                'commentable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'commentable_id' => 11,
                'created_at' => '2019-01-28 06:28:37',
                'updated_at' => '2019-01-28 06:28:37',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'comment' => 'sdasdsadsad',
                'approved' => 0,
                'commentable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'commentable_id' => 31,
                'created_at' => '2019-02-10 09:31:20',
                'updated_at' => '2019-02-10 09:31:20',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'comment' => 'Testing comment feature for recipes',
                'approved' => 0,
                'commentable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'commentable_id' => 11,
                'created_at' => '2019-02-11 06:25:52',
                'updated_at' => '2019-02-11 06:25:52',
            ),
        ));
        
        
    }
}