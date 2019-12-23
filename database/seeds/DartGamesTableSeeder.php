<?php

use Illuminate\Database\Seeder;

class DartGamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dart__games')->delete();
        
        \DB::table('dart__games')->insert(array (
            0 => 
            array (
                'id' => 68,
                'type' => '301',
                'status' => 'Completed',
                't1_players' => 0,
                't2_players' => 0,
                'ind_players' => 3,
                'created_at' => '2019-12-09 09:48:37',
                'updated_at' => '2019-12-10 06:58:58',
            ),
            1 => 
            array (
                'id' => 69,
                'type' => '301',
                'status' => 'Completed',
                't1_players' => 2,
                't2_players' => 2,
                'ind_players' => 0,
                'created_at' => '2019-12-09 09:49:22',
                'updated_at' => '2019-12-10 07:25:29',
            ),
            2 => 
            array (
                'id' => 70,
                'type' => '301',
                'status' => 'Completed',
                't1_players' => 0,
                't2_players' => 0,
                'ind_players' => 2,
                'created_at' => '2019-12-09 11:18:32',
                'updated_at' => '2019-12-09 13:26:16',
            ),
            3 => 
            array (
                'id' => 71,
                'type' => '301',
                'status' => 'Completed',
                't1_players' => 0,
                't2_players' => 0,
                'ind_players' => 2,
                'created_at' => '2019-12-09 16:24:13',
                'updated_at' => '2019-12-09 16:32:01',
            ),
            4 => 
            array (
                'id' => 72,
                'type' => '301',
                'status' => 'In Progress',
                't1_players' => 2,
                't2_players' => 2,
                'ind_players' => 0,
                'created_at' => '2019-12-10 11:24:02',
                'updated_at' => '2019-12-10 11:26:42',
            ),
            5 => 
            array (
                'id' => 73,
                'type' => '301',
                'status' => 'Completed',
                't1_players' => 3,
                't2_players' => 3,
                'ind_players' => 0,
                'created_at' => '2019-12-10 11:27:39',
                'updated_at' => '2019-12-10 16:38:04',
            ),
            6 => 
            array (
                'id' => 74,
                'type' => '301',
                'status' => 'In Progress',
                't1_players' => 0,
                't2_players' => 0,
                'ind_players' => 2,
                'created_at' => '2019-12-10 16:40:11',
                'updated_at' => '2019-12-10 21:33:05',
            ),
            7 => 
            array (
                'id' => 75,
                'type' => '301',
                'status' => 'In Progress',
                't1_players' => 2,
                't2_players' => 2,
                'ind_players' => 0,
                'created_at' => '2019-12-11 20:06:39',
                'updated_at' => '2019-12-11 20:07:00',
            ),
            8 => 
            array (
                'id' => 76,
                'type' => '301',
                'status' => 'In Progress',
                't1_players' => 0,
                't2_players' => 0,
                'ind_players' => 2,
                'created_at' => '2019-12-11 20:13:59',
                'updated_at' => '2019-12-11 20:14:20',
            ),
        ));
        
        
    }
}