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
                'id' => 11,
                'user_id' => 2,
                'comment' => 'fdsfdsfds',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 7,
                'created_at' => '2019-07-21 09:17:19',
                'updated_at' => '2019-07-21 09:17:19',
            ),
            10 => 
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
            11 => 
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
            12 => 
            array (
                'id' => 15,
                'user_id' => 2,
                'comment' => 'Best banana loaf around bar none',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Recipes\\Recipe',
                'commentable_id' => 4,
                'created_at' => '2019-08-13 15:26:40',
                'updated_at' => '2019-09-27 05:40:56',
            ),
            13 => 
            array (
                'id' => 16,
                'user_id' => 2,
                'comment' => 'Comment number 2',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 11,
                'created_at' => '2019-08-14 12:03:13',
                'updated_at' => '2019-08-14 12:03:13',
            ),
            14 => 
            array (
                'id' => 18,
                'user_id' => 3,
                'comment' => 'First comment from Stacie\'s account',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Recipes\\Recipe',
                'commentable_id' => 10,
                'created_at' => '2019-08-14 12:34:37',
                'updated_at' => '2019-08-14 12:34:37',
            ),
            15 => 
            array (
                'id' => 19,
                'user_id' => 3,
                'comment' => 'Comment number 1 Comment number 1 Comment number 1 Comment number 1 Comment number 1 Comment number 1',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 14,
                'created_at' => '2019-08-14 13:28:33',
                'updated_at' => '2019-08-14 13:28:33',
            ),
            16 => 
            array (
                'id' => 20,
                'user_id' => 3,
                'comment' => '<p>adding a new comment to this post to test and make sure it is working as expected on this day</p>',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Post',
                'commentable_id' => 23,
                'created_at' => '2019-08-14 13:29:31',
                'updated_at' => '2019-08-14 13:29:31',
            ),
            17 => 
            array (
                'id' => 21,
                'user_id' => 3,
                'comment' => '<p>Second blog comment</p>',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Posts\\Post',
                'commentable_id' => 2,
                'created_at' => '2019-09-27 15:13:09',
                'updated_at' => '2019-09-27 15:13:09',
            ),
            18 => 
            array (
                'id' => 22,
                'user_id' => 3,
                'comment' => 'ssasadsad',
                'approved' => 0,
                'commentable_type' => 'App\\Models\\Projects\\Project',
                'commentable_id' => 20,
                'created_at' => '2019-10-07 14:06:32',
                'updated_at' => '2019-10-07 14:06:32',
            ),
        ));
        
        
    }
}