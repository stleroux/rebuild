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
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'entrees',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-23 07:40:52',
                'updated_at' => '2019-03-03 07:54:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'desserts',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-23 07:41:38',
                'updated_at' => '2019-02-23 07:41:38',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'name' => 'drinks',
                'value' => NULL,
                'description' => '',
                'created_at' => '2019-02-23 07:42:42',
                'updated_at' => '2019-02-23 07:42:42',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'name' => 'beef',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-23 23:19:01',
                'updated_at' => '2019-02-23 23:19:01',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'name' => 'pork',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-27 08:51:56',
                'updated_at' => '2019-02-27 08:51:56',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'name' => 'chicken',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-27 08:52:07',
                'updated_at' => '2019-02-27 08:52:07',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 3,
                'name' => 'cakes',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-27 09:01:35',
                'updated_at' => '2019-02-27 09:01:35',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 3,
                'name' => 'cookies',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-02-27 09:01:45',
                'updated_at' => '2019-02-27 09:01:45',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 3,
                'name' => 'pies',
                'value' => NULL,
                'description' => '',
                'created_at' => '2019-02-27 09:01:55',
                'updated_at' => '2019-02-27 09:01:55',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 0,
                'name' => 'articles',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-01 07:48:19',
                'updated_at' => '2019-03-01 07:48:19',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'name' => 'projects',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-01 07:48:31',
                'updated_at' => '2019-03-01 07:48:31',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 11,
                'name' => 'site',
                'value' => NULL,
                'description' => '',
                'created_at' => '2019-03-01 15:39:38',
                'updated_at' => '2019-03-01 15:39:38',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 0,
                'name' => 'wood type',
                'value' => NULL,
                'description' => '',
                'created_at' => '2019-03-01 15:39:59',
                'updated_at' => '2019-03-01 15:39:59',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'name' => 'wood specie',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:54:15',
                'updated_at' => '2019-03-02 07:54:15',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 0,
                'name' => 'stain type',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:54:31',
                'updated_at' => '2019-03-02 07:54:31',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 0,
                'name' => 'stain color',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 0,
                'name' => 'stain sheen',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'parent_id' => 0,
                'name' => 'finish type',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:55:39',
                'updated_at' => '2019-03-02 07:55:39',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'parent_id' => 0,
                'name' => 'finish sheen',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-02 07:55:24',
                'updated_at' => '2019-03-02 07:55:24',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 32,
                'parent_id' => 4,
                'name' => 'hotDrinks',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 11:12:11',
                'updated_at' => '2019-03-03 21:59:12',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 33,
                'parent_id' => 1,
                'name' => 'salads',
                'value' => NULL,
                'description' => 'N/A',
                'created_at' => '2019-03-03 16:54:15',
                'updated_at' => '2019-03-03 16:54:15',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 34,
                'parent_id' => 33,
                'name' => 'Pasta',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 16:55:33',
                'updated_at' => '2019-03-03 16:55:33',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 35,
                'parent_id' => 33,
                'name' => 'garden',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 16:58:35',
                'updated_at' => '2019-03-03 16:58:35',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 36,
                'parent_id' => 3,
                'name' => 'fruitDishes',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 17:03:08',
                'updated_at' => '2019-03-03 17:03:08',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 38,
                'parent_id' => 1,
                'name' => 'Soups',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 21:52:50',
                'updated_at' => '2019-03-03 21:52:50',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 39,
                'parent_id' => 38,
                'name' => 'hotSoups',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-03 21:57:02',
                'updated_at' => '2019-03-03 21:57:02',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 40,
                'parent_id' => 4,
                'name' => 'Alcoholic',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-25 13:51:52',
                'updated_at' => '2019-09-20 08:15:48',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 41,
                'parent_id' => 4,
                'name' => 'coldDrinks',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-03-25 13:54:03',
                'updated_at' => '2019-03-25 13:54:03',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 59,
                'parent_id' => 0,
                'name' => 'posts',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-04-08 11:26:28',
                'updated_at' => '2019-04-08 11:26:28',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 60,
                'parent_id' => 59,
                'name' => 'site',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-04-08 11:26:58',
                'updated_at' => '2019-04-08 11:28:16',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 62,
                'parent_id' => 60,
                'name' => 'general',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-04-08 11:49:39',
                'updated_at' => '2019-04-08 11:49:39',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 65,
                'parent_id' => 13,
                'name' => 'qwerty',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-04-08 12:40:10',
                'updated_at' => '2019-04-08 12:40:10',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 67,
                'parent_id' => 12,
                'name' => 'Type',
                'value' => NULL,
                'description' => 'Project types',
                'created_at' => '2019-06-24 08:37:48',
                'updated_at' => '2019-06-24 08:37:48',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 68,
                'parent_id' => 67,
                'name' => 'general',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-06-24 11:40:48',
                'updated_at' => '2019-06-24 11:40:48',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 69,
                'parent_id' => 67,
                'name' => 'furniture',
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2019-06-24 11:44:08',
                'updated_at' => '2019-06-24 11:44:08',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}