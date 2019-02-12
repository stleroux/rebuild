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
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 11:58:45',
                'updated_at' => NULL,
                'last_login_date' => '2019-02-12 11:58:45',
                'login_count' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'lerouxs',
                'email' => 'stleroux@hotmail.ca',
                'public_email' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => 'FqZUULp12dhFZrQtukB5Rvef4OhB3E78UzNc4fNQ0uZHRBBWY8jyWZme3gZy',
                'created_at' => '2018-10-24 16:31:15',
                'updated_at' => '2019-02-12 11:23:57',
                'last_login_date' => '2019-02-12 11:23:57',
                'login_count' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'hayness',
                'email' => 'stacie@hotmail.com',
                'public_email' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$968BD2.11mQxrGfKeBWRj.dcgWLalEGjWHX1XKmxk.H.ZP6YPLGau',
                'remember_token' => '55DOB2ljWdlxmhPsrdHq4RPmZLmlSJUgZqAotkJcpUIYEall3mD2hPJZoXHs',
                'created_at' => '2018-11-02 11:55:55',
                'updated_at' => '2018-11-02 11:55:55',
                'last_login_date' => '0000-00-00 00:00:00',
                'login_count' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'username' => 'lerouxh',
                'email' => 'hugues.leroux@rogers.com',
                'public_email' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 11:59:48',
                'updated_at' => NULL,
                'last_login_date' => '2019-02-12 11:17:35',
                'login_count' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'username' => 'leveillel',
                'email' => 'luc.leveille@icloud.com',
                'public_email' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 12:00:21',
                'updated_at' => NULL,
                'last_login_date' => '2019-02-12 11:15:48',
                'login_count' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'username' => 'tremblayj',
                'email' => 'julien.tremblay@dfo-mpo.gc.ca',
                'public_email' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 12:02:16',
                'updated_at' => NULL,
                'last_login_date' => '2019-02-12 12:02:16',
                'login_count' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'username' => 'haynesb',
                'email' => 'brenda.haynes@hotmail.com',
                'public_email' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 12:02:46',
                'updated_at' => NULL,
                'last_login_date' => '2019-02-12 12:02:46',
                'login_count' => 0,
            ),
        ));
        
        
    }
}