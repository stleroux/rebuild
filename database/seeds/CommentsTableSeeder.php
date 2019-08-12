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
                'commentable_type' => 'Modules\\Posts\\Entities\\Post',
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
                'commentable_type' => 'Modules\\Recipes\\Entities\\Recipe',
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
            5 => 
            array (
                'id' => 6,
                'user_id' => 2,
                'comment' => 'test test test test',
                'approved' => 0,
                'commentable_type' => 'Modules\\Recipes\\Entities\\Recipe',
                'commentable_id' => 11,
                'created_at' => '2019-02-12 12:20:40',
                'updated_at' => '2019-02-12 12:20:40',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'comment' => 'First comment for this recipe',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Recipes\\Recipe',
                'commentable_id' => 10,
                'created_at' => '2019-06-10 13:15:07',
                'updated_at' => '2019-06-10 13:15:07',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 2,
                'comment' => '22222222222222',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Recipes\\Recipe',
                'commentable_id' => 10,
                'created_at' => '2019-06-10 13:16:12',
                'updated_at' => '2019-06-10 13:16:12',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 2,
                'comment' => 'testing',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 8,
                'created_at' => '2019-07-21 07:08:49',
                'updated_at' => '2019-07-21 07:08:49',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 2,
                'comment' => 'Best Qwerty project ever built',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 10,
                'created_at' => '2019-07-21 08:17:53',
                'updated_at' => '2019-07-21 08:17:53',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 2,
                'comment' => 'fdsfdsfds',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 7,
                'created_at' => '2019-07-21 09:17:19',
                'updated_at' => '2019-07-21 09:17:19',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 2,
                'comment' => 'lkjgsdflgkjalkgjalgkj',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 6,
                'created_at' => '2019-07-21 10:20:22',
                'updated_at' => '2019-07-21 10:20:22',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 2,
                'comment' => '1
2
3
4
5
6
7
8
9',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 11,
                'created_at' => '2019-07-24 06:14:16',
                'updated_at' => '2019-07-24 06:14:16',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 2,
                'comment' => '<p>assdsadsad</p>',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Post',
                'commentable_id' => 2,
                'created_at' => '2019-07-30 21:56:27',
                'updated_at' => '2019-07-30 21:56:27',
            ),
        ));
        
        
    }
}