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
                'username' => 'lerouxs',
                'email' => 'stleroux@hotmail.ca',
                'email_verified_at' => NULL,
                'password' => '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe',
                'remember_token' => 'FqZUULp12dhFZrQtukB5Rvef4OhB3E78UzNc4fNQ0uZHRBBWY8jyWZme3gZy',
                'created_at' => '2018-10-24 16:31:15',
                'updated_at' => '2018-10-24 16:31:15',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'hayness',
                'email' => 'stacie@hotmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$968BD2.11mQxrGfKeBWRj.dcgWLalEGjWHX1XKmxk.H.ZP6YPLGau',
                'remember_token' => '55DOB2ljWdlxmhPsrdHq4RPmZLmlSJUgZqAotkJcpUIYEall3mD2hPJZoXHs',
                'created_at' => '2018-11-02 11:55:55',
                'updated_at' => '2018-11-02 11:55:55',
            ),
        ));
        
        
    }
}