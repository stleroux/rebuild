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
                'updated_at' => '2019-08-09 07:27:23',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'from_email',
                'value' => 'stleroux@hotmail.ca',
                'description' => 'The email address to be used when sending messages from the application \\ website',
                'tab' => 'general',
                'created_at' => NULL,
                'updated_at' => '2019-08-09 07:27:23',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'from_name',
                'value' => 'Stephane',
                'description' => 'The name that will appear in the From field of messages sent from the application \\ website',
                'tab' => 'general',
                'created_at' => NULL,
                'updated_at' => '2019-08-09 07:27:23',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'login_count_warning',
                'value' => '10',
                'description' => 'Number of times a user must login for the New User block to stop appearing on the homepage',
                'tab' => 'site',
                'created_at' => NULL,
                'updated_at' => '2019-08-09 07:27:23',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'no_records_found',
                'value' => 'No records found',
                'description' => 'Message to display when no records are found',
                'tab' => 'site',
                'created_at' => '2019-01-29 12:41:25',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'homepage_favorite_recipe_count',
                'value' => '5',
                'description' => 'Number of recipes to show on the homepage\'s Most Popular block',
                'tab' => 'site',
                'created_at' => '2019-01-29 14:18:31',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'homepage_favorite_post_count',
                'value' => '5',
                'description' => 'Number of posts to show on the homepage\'s Most Popular block',
                'tab' => 'site',
                'created_at' => '2019-02-02 07:02:32',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'homepage_blog_count',
                'value' => '3',
                'description' => 'How many blog posts to display on the home page',
                'tab' => 'site',
                'created_at' => '2019-02-03 12:35:58',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'authorFormat',
                'value' => 'first_name last_name',
            'description' => 'How the author name will be displayed throughout the website (username - last_name, first_name - first_name last_name)',
                'tab' => 'general',
                'created_at' => '2019-02-09 06:18:53',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'dateFormat',
                'value' => 'M d, Y',
                'description' => 'The date format used throughout the site. Use PHP date formats',
                'tab' => 'general',
                'created_at' => '2019-02-10 06:38:38',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'invoicer.companyName',
                'value' => 'TheWoodBarn.ca',
                'description' => 'Name of company to display on invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:31:43',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'invoicer.address_1',
                'value' => '1216 Ste Marie Rd',
                'description' => 'Value to display on invoices in the address_1 location',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:35:19',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'invoicer.address_2',
                'value' => NULL,
                'description' => 'Value to display in the address_2 location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:36:07',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'invoicer.city',
                'value' => 'Embrun',
                'description' => 'Value to display in the companyCity location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:36:36',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'invoicer.state',
                'value' => 'On',
                'description' => 'Value to display in the state location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:36:59',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'invoicer.zip',
                'value' => 'K0A 1W0',
                'description' => 'Value to display in the zip location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:37:28',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'invoicer.telephone',
            'value' => '(613) 370-0275',
                'description' => 'Value to display in the telephone location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:37:52',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'invoicer.fax',
            'value' => '(613) 370-0275',
                'description' => 'Value to display in the fax location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:38:24',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'invoicer.email',
                'value' => 'stleroux@hotmail.ca',
                'description' => 'Value to display in the email location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:38:45',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'invoicer.website',
                'value' => 'TheWoodBarn.ca',
                'description' => 'Value to display in the website location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:39:12',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'invoicer.hstNo',
                'value' => NULL,
                'description' => 'Value to display in the HST No location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:39:38',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'invoicer.wsibNo',
                'value' => NULL,
                'description' => 'Value to display in the WSIB No location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:40:01',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'invoicer.termsAndConditions',
                'value' => NULL,
                'description' => 'Value to display in the Terms and conditions location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:40:32',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'invoicer.hstRate',
                'value' => '0.13',
                'description' => 'Value to display in the HST Rate location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:40:51',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'invoicer.wsibRate',
                'value' => '.12',
                'description' => 'Value to display in the WSIB Rate location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:41:17',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'invoicer.incomeTaxRate',
                'value' => '0.26',
                'description' => 'Value to display in the Income Tax Rate location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:41:51',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'invoicer.version',
                'value' => '2.0',
                'description' => 'Value to display in the version location on the invoices',
                'tab' => 'invoicer',
                'created_at' => '2019-05-13 12:42:15',
                'updated_at' => '2019-08-09 07:27:23',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'admin_user_account',
                'value' => 'administrator',
                'description' => 'Select the account that will have SUPER ADMIN access to the site. Usually this is administrator',
                'tab' => 'site',
                'created_at' => '2019-08-09 07:12:21',
                'updated_at' => '2019-08-09 07:27:23',
            ),
        ));
        
        
    }
}