<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test',
                'created_at' => '2018-12-28 10:20:10',
                'updated_at' => '2018-12-28 10:20:10',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Stephane',
                'created_at' => '2018-12-28 10:23:00',
                'updated_at' => '2018-12-28 10:23:00',
            ),
        ));
        
        
    }
}