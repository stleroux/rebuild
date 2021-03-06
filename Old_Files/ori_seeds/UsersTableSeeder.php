<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'administrator',
                'email' => 'admin@thewoodbarn.ca',
                'public_email' => 0,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'first_name' => 'Admin',
                'last_name' => 'Istrator',
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => 'The Admin Specialists',
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => 1,
                'landing_page_id' => '41',
                'rows_per_page' => 15,
                'display_size' => 'normal',
                'action_buttons' => '1',
                'author_format' => '1',
                'alert_fade_time' => 5000,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '2019-02-12 11:58:45',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-02-12 11:58:45',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'lerouxs',
                'email' => 'stleroux@hotmail.ca',
                'public_email' => 1,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'first_name' => 'Stephane',
                'last_name' => 'Leroux',
                'telephone' => '613-370-0275',
                'cell' => '613-402-0275',
                'fax' => '613-123-4567',
                'website' => 'thewoodbarn.ca',
                'company_name' => 'TheWoodBarn.ca',
                'image' => '1565629121.jpg',
                'civic_number' => '1216',
                'address_1' => 'Ste Marie Rd',
                'address_2' => NULL,
                'city' => 'Embrun',
                'province' => 'On',
                'postal_code' => 'K0A 1W0',
                'notes' => 'Nothing special',
                'invoicer_client' => NULL,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => 'BV6dhMawrvQSbf4dehchBDEa4NoQiLBasGPswOaXEgh4Efu4jTWwbKK1izH9',
                'previous_login_date' => '2019-11-15 07:40:55',
                'last_login_date' => '2019-10-07 12:20:21',
                'login_count' => 174,
                'email_verified_at' => NULL,
                'created_at' => '2016-06-21 08:52:05',
                'updated_at' => '2019-11-15 07:40:55',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'hayness',
                'email' => 'stacie@hotmail.com',
                'public_email' => 0,
                'password' => '$2y$10$3MWYjM4NqbZ3Vf7y9HYbleivjht8ExnuoLD6tDl/qFZLU1.pi9sNG',
                'first_name' => 'Stacie',
                'last_name' => 'Haynes',
                'telephone' => '613-370-0275',
                'cell' => '613-327-4722',
                'fax' => NULL,
                'website' => 'dsfdsfds',
                'company_name' => 'ABC Company',
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 1,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => 'C6pvXZ26joKO7YjQwO5lKWIovPL2JhUOBTPlCB7u2ZWI7zsTByiR3p1zSKEE',
                'previous_login_date' => '2019-10-07 14:00:23',
                'last_login_date' => '2019-09-27 15:11:28',
                'login_count' => 36,
                'email_verified_at' => NULL,
                'created_at' => '2018-11-02 11:55:55',
                'updated_at' => '2019-11-05 21:53:49',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'username' => 'lerouxh',
                'email' => 'hugues.leroux@rogers.com',
                'public_email' => 0,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'first_name' => NULL,
                'last_name' => 'Leroux',
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => 'Wade Redden Corporation',
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => 1,
                'landing_page_id' => '41',
                'rows_per_page' => 15,
                'display_size' => 'normal',
                'action_buttons' => '1',
                'author_format' => '1',
                'alert_fade_time' => 5000,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '2019-02-12 11:17:35',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-02-12 11:59:48',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'username' => 'leveillel',
                'email' => 'luc.leveille@icloud.com',
                'public_email' => 0,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => 1,
                'landing_page_id' => '41',
                'rows_per_page' => 15,
                'display_size' => 'normal',
                'action_buttons' => '1',
                'author_format' => '1',
                'alert_fade_time' => 5000,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '2019-02-12 11:15:48',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-02-12 12:00:21',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'username' => 'tremblayj',
                'email' => 'julien.tremblay@dfo-mpo.gc.ca',
                'public_email' => 0,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => 1,
                'landing_page_id' => '41',
                'rows_per_page' => 15,
                'display_size' => 'normal',
                'action_buttons' => '1',
                'author_format' => '1',
                'alert_fade_time' => 5000,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '2019-02-12 12:02:16',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-02-12 12:02:16',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'username' => 'haynesb',
                'email' => 'brenda.haynes@hotmail.com',
                'public_email' => 0,
                'password' => '$2y$10$MDWeLaGsK37mO9M5TJh/wevnbilYZYwHSSvXSkdQQmSnAfK4UvM.2',
                'first_name' => '1',
                'last_name' => '2',
                'telephone' => '4',
                'cell' => '5',
                'fax' => '6',
                'website' => '7',
                'company_name' => 'Brenda Haynes',
                'image' => '1565574347.jpg',
                'civic_number' => '8',
                'address_1' => '9',
                'address_2' => '10',
                'city' => '11',
                'province' => '12',
                'postal_code' => '13',
                'notes' => '141516',
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => 0,
                'landing_page_id' => '',
                'rows_per_page' => 0,
                'display_size' => 'normal',
                'action_buttons' => '',
                'author_format' => '',
                'alert_fade_time' => 0,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => '2019-10-27 06:24:37',
                'last_login_date' => '2019-02-12 12:02:46',
                'login_count' => 2,
                'email_verified_at' => NULL,
                'created_at' => '2019-02-12 12:02:46',
                'updated_at' => '2019-10-27 06:24:37',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'username' => '111111',
                'email' => '111@111.com',
                'public_email' => 0,
                'password' => '$2y$10$FLny.RQ10jtaQwAmJnfLYOt/HBnD4sG.PAZjbUNkgQw5x4C4Jl.Lq',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '0000-00-00 00:00:00',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-08-25 21:32:02',
                'updated_at' => '2019-08-25 21:35:36',
                'deleted_at' => '2019-08-25 21:35:36',
            ),
            8 => 
            array (
                'id' => 9,
                'username' => '11111',
                'email' => '111@1111.com',
                'public_email' => 0,
                'password' => '$2y$10$C1P5gA0ePHl5wc3bCQGDAepPETKnjPMQ2u5pPoChowMsX6GBwlLUW',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 1,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '0000-00-00 00:00:00',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-08-25 21:36:03',
                'updated_at' => '2019-08-25 21:37:10',
                'deleted_at' => '2019-08-25 21:37:10',
            ),
            9 => 
            array (
                'id' => 10,
                'username' => '22222',
                'email' => '22222@2222.com',
                'public_email' => 0,
                'password' => '$2y$10$7VlOsPMfXVkT1ff7/e94U.vVDECCfZV//tTmIDVb5DyL9EXFaCOfO',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => '0000-00-00 00:00:00',
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-08-25 21:46:06',
                'updated_at' => '2019-09-21 07:43:31',
                'deleted_at' => '2019-09-21 07:43:31',
            ),
            10 => 
            array (
                'id' => 11,
                'username' => '_wqwqwqw',
                'email' => 'test@test.com',
                'public_email' => 0,
                'password' => '$2y$10$H83s90aFkX1jJ9Ed0pewZOImS7B.yr.NLClAT04XdL0CxAvsYuXAy',
                'first_name' => NULL,
                'last_name' => NULL,
                'telephone' => NULL,
                'cell' => NULL,
                'fax' => NULL,
                'website' => NULL,
                'company_name' => NULL,
                'image' => NULL,
                'civic_number' => NULL,
                'address_1' => NULL,
                'address_2' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'notes' => NULL,
                'invoicer_client' => 0,
                'frontendStyle' => 'slate',
                'backendStyle' => 'bootstrap',
                'date_format' => NULL,
                'landing_page_id' => NULL,
                'rows_per_page' => NULL,
                'display_size' => 'normal',
                'action_buttons' => NULL,
                'author_format' => NULL,
                'alert_fade_time' => NULL,
                'layout' => 1,
                'remember_token' => NULL,
                'previous_login_date' => NULL,
                'last_login_date' => NULL,
                'login_count' => 0,
                'email_verified_at' => NULL,
                'created_at' => '2019-10-07 13:41:39',
                'updated_at' => '2019-10-07 13:44:20',
                'deleted_at' => '2019-10-07 13:44:20',
            ),
        ));
        
        
    }
}