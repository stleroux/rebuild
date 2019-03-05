<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'name' => 'recipes',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'entrees',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-23 07:40:52',
                'updated_at' => '2019-03-03 07:54:51',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'desserts',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-23 07:41:38',
                'updated_at' => '2019-02-23 07:41:38',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'name' => 'drinks',
                'value' => NULL,
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2019-02-23 07:42:42',
                'updated_at' => '2019-02-23 07:42:42',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'name' => 'beef',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-23 23:19:01',
                'updated_at' => '2019-02-23 23:19:01',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'name' => 'pork',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-27 08:51:56',
                'updated_at' => '2019-02-27 08:51:56',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'name' => 'chicken',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-27 08:52:07',
                'updated_at' => '2019-02-27 08:52:07',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 3,
                'name' => 'cakes',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-27 09:01:35',
                'updated_at' => '2019-02-27 09:01:35',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 3,
                'name' => 'cookies',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-02-27 09:01:45',
                'updated_at' => '2019-02-27 09:01:45',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 3,
                'name' => 'pies',
                'value' => NULL,
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2019-02-27 09:01:55',
                'updated_at' => '2019-02-27 09:01:55',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 0,
                'name' => 'articles',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-01 07:48:19',
                'updated_at' => '2019-03-01 07:48:19',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'name' => 'projects',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-01 07:48:31',
                'updated_at' => '2019-03-01 07:48:31',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 11,
                'name' => 'site',
                'value' => NULL,
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2019-03-01 15:39:38',
                'updated_at' => '2019-03-01 15:39:38',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 12,
                'name' => 'wood type',
                'value' => NULL,
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2019-03-01 15:39:59',
                'updated_at' => '2019-03-01 15:39:59',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 12,
                'name' => 'wood specie',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:54:15',
                'updated_at' => '2019-03-02 07:54:15',
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 12,
                'name' => 'stain type',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:54:31',
                'updated_at' => '2019-03-02 07:54:31',
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 12,
                'name' => 'stain color',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 12,
                'name' => 'stain sheen',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
            ),
            18 => 
            array (
                'id' => 19,
                'parent_id' => 12,
                'name' => 'finish type',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
            ),
            19 => 
            array (
                'id' => 20,
                'parent_id' => 12,
                'name' => 'finish sheen',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-02 07:55:24',
                'updated_at' => '2019-03-02 07:55:24',
            ),
            20 => 
            array (
                'id' => 32,
                'parent_id' => 4,
                'name' => 'hot drinks',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 11:12:11',
                'updated_at' => '2019-03-03 21:59:12',
            ),
            21 => 
            array (
                'id' => 33,
                'parent_id' => 1,
                'name' => 'salads',
                'value' => NULL,
                'description' => 'N/A',
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 16:54:15',
                'updated_at' => '2019-03-03 16:54:15',
            ),
            22 => 
            array (
                'id' => 34,
                'parent_id' => 33,
                'name' => 'Pasta',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 16:55:33',
                'updated_at' => '2019-03-03 16:55:33',
            ),
            23 => 
            array (
                'id' => 35,
                'parent_id' => 33,
                'name' => 'garden',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 16:58:35',
                'updated_at' => '2019-03-03 16:58:35',
            ),
            24 => 
            array (
                'id' => 36,
                'parent_id' => 3,
                'name' => 'Fruit Dishes',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 17:03:08',
                'updated_at' => '2019-03-03 17:03:08',
            ),
            25 => 
            array (
                'id' => 38,
                'parent_id' => 1,
                'name' => 'Soups',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 21:52:50',
                'updated_at' => '2019-03-03 21:52:50',
            ),
            26 => 
            array (
                'id' => 39,
                'parent_id' => 38,
                'name' => 'hot soups',
                'value' => NULL,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-03 21:57:02',
                'updated_at' => '2019-03-03 21:57:02',
            ),
        ));
        
        
    }
}