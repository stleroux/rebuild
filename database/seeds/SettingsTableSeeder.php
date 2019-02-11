<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'app_name',
                'value' => 'TheWoodBarn.ca',
                'description' => 'The name of the application \\ website',
                'tab' => 'general',
                'created_at' => NULL,
                'updated_at' => '2019-02-10 14:23:32',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'from_email',
                'value' => 'stleroux@hotmail.ca',
                'description' => 'The email address to be used when sending messages from the application \\ website',
                'tab' => 'general',
                'created_at' => NULL,
                'updated_at' => '2019-02-10 14:23:32',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'from_name',
                'value' => 'Stephane',
                'description' => 'The name that will appear in the From field of messages sent from the application \\ website',
                'tab' => 'general',
                'created_at' => NULL,
                'updated_at' => '2019-02-10 14:23:32',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'login_count_warning',
                'value' => '56',
                'description' => 'Number of times a user must login for the First Time User block on homepage to stop appearing',
                'tab' => 'profile',
                'created_at' => NULL,
                'updated_at' => '2019-02-10 14:23:32',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'no_records_found',
                'value' => 'No records found',
                'description' => 'Message to display when no records are found',
                'tab' => 'profile',
                'created_at' => '2019-01-29 12:41:25',
                'updated_at' => '2019-02-10 14:23:32',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'homepage_favorite_recipe_count',
                'value' => '5',
                'description' => 'Number of recipes to show on the homepage\'s Most Popular block',
                'tab' => 'profile',
                'created_at' => '2019-01-29 14:18:31',
                'updated_at' => '2019-02-10 14:23:32',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'homepage_favorite_post_count',
                'value' => '2',
                'description' => 'Number of posts to show on the homepage\'s Most Popular block',
                'tab' => 'profile',
                'created_at' => '2019-02-02 07:02:32',
                'updated_at' => '2019-02-10 14:23:32',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'homepage_blog_count',
                'value' => '3',
                'description' => 'How many blog posts to display on the home page',
                'tab' => 'profile',
                'created_at' => '2019-02-03 12:35:58',
                'updated_at' => '2019-02-10 14:23:32',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'authorFormat',
                'value' => 'username',
            'description' => 'How the author name will be displayed throughout the website (username - last_name, first_name - first_name last_name)',
                'tab' => 'general',
                'created_at' => '2019-02-09 06:18:53',
                'updated_at' => '2019-02-10 14:23:32',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'dateFormat',
                'value' => 'M d, Y',
                'description' => 'The date format used throughout the site. Use PHP date formats',
                'tab' => 'general',
                'created_at' => '2019-02-10 06:38:38',
                'updated_at' => '2019-02-10 14:23:32',
            ),
        ));
        
        
    }
}