<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'category_id' => 1,
                'title' => 'First Post',
                'body' => 'Body of first post',
                'slug' => 'first_post',
                'image' => '1495544253.png',
                'views' => 63,
                'created_at' => '2017-12-28 13:10:28',
                'updated_at' => '2019-08-22 20:33:43',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 3,
                'deleted_at' => '2019-08-22 20:33:43',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 4,
                'category_id' => 1,
                'title' => 'Second blog',
                'body' => 'Content of second blog Content of second blog Content of second blog Content of second blog Content of second blog Content of second blog ',
                'slug' => 'second_blog',
                'image' => '1495544315.png',
                'views' => 180,
                'created_at' => '2017-12-28 13:20:18',
                'updated_at' => '2019-09-01 13:47:27',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 3,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'category_id' => 2,
                'title' => 'Third post',
                'body' => '<p>sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd </p>',
                'slug' => 'aaaaaaaaaaaaaaa',
                'image' => '1483551182.jpg',
                'views' => 5,
                'created_at' => '2019-08-31 08:12:11',
                'updated_at' => '2019-08-22 19:30:15',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 3,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 21,
                'user_id' => 1,
                'category_id' => 2,
                'title' => 'Fourth post',
                'body' => '<p>111111111111111</p>',
                'slug' => '11111111111111',
                'image' => '1496342208.jpg',
                'views' => 4,
                'created_at' => '2017-06-01 12:53:01',
                'updated_at' => '2019-10-07 12:19:56',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 3,
                'deleted_at' => '2019-10-07 12:19:56',
            ),
            4 => 
            array (
                'id' => 23,
                'user_id' => 3,
                'category_id' => 38,
                'title' => 'Fifth post',
                'body' => '<p>Body of new post</p>',
                'slug' => 'new_post',
                'image' => '1496335034.png',
                'views' => 43,
                'created_at' => '2017-06-21 13:01:19',
                'updated_at' => '2019-10-07 12:19:56',
                'published_at' => '2019-09-05 20:43:20',
                'modified_by_id' => 3,
                'deleted_at' => '2019-10-07 12:19:56',
            ),
            5 => 
            array (
                'id' => 25,
                'user_id' => 2,
                'category_id' => 2,
                'title' => 'Sixth post',
                'body' => '<p>klj j ljklkj klj klj klj klj lkj klj kl jklj klj</p>',
                'slug' => 'post-test',
                'image' => '1498587512.jpg',
                'views' => 28,
                'created_at' => '2017-08-08 09:16:08',
                'updated_at' => '2019-08-14 07:21:21',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 3,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 26,
                'user_id' => 2,
                'category_id' => 65,
                'title' => 'Seventh post',
                'body' => '<p>dsd sadasdas dsd</p>',
                'slug' => 'test111',
                'image' => NULL,
                'views' => 25,
                'created_at' => '2019-08-23 06:10:48',
                'updated_at' => '2019-09-01 13:47:27',
                'published_at' => '2019-09-02 07:18:34',
                'modified_by_id' => 2,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 27,
                'user_id' => 2,
                'category_id' => 62,
                'title' => 'Eightth post',
                'body' => '<p>dsadsadsad</p>',
                'slug' => 'sdsdsad',
                'image' => NULL,
                'views' => 95,
                'created_at' => '2019-08-23 21:45:43',
                'updated_at' => '2019-10-07 12:11:18',
                'published_at' => NULL,
                'modified_by_id' => 2,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 28,
                'user_id' => 3,
                'category_id' => 65,
                'title' => 'Nineth post',
                'body' => '<p>ftjftrjrfjhfrcj</p>',
                'slug' => 'rdrdsdss',
                'image' => NULL,
                'views' => 19,
                'created_at' => '2019-08-29 21:20:45',
                'updated_at' => '2019-09-05 20:41:19',
                'published_at' => '2019-09-05 20:41:19',
                'modified_by_id' => 3,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 29,
                'user_id' => 2,
                'category_id' => 62,
                'title' => 'a12345',
                'body' => '<p>dsksdsd</p>
<p>sad</p>
<p>sadsad</p>
<p>sad</p>
<p>sad</p>
<p>sadsa</p>',
                'slug' => '12345',
                'image' => '1570671973.jpeg',
                'views' => 0,
                'created_at' => '2019-10-09 21:46:14',
                'updated_at' => '2019-10-09 22:00:05',
                'published_at' => NULL,
                'modified_by_id' => 2,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}