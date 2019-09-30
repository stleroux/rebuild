<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'permission_index',
                'display_name' => 'index',
                'model' => 'permission',
                'description' => 'List permissions',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:04:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'permission_create',
                'display_name' => 'create',
                'model' => 'permission',
                'description' => 'Create and store permissions',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:04:54',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'permission_edit',
                'display_name' => 'edit',
                'model' => 'permission',
                'description' => 'Edit permissions',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:08',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'permission_delete',
                'display_name' => 'delete',
                'model' => 'permission',
                'description' => 'Delete permissions',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:15',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'permission_show',
                'display_name' => 'show',
                'model' => 'permission',
                'description' => 'View permission',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'user_index',
                'display_name' => 'index',
                'model' => 'user',
                'description' => 'List users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:41',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'user_create',
                'display_name' => 'create',
                'model' => 'user',
                'description' => 'Create users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:53',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'user_edit',
                'display_name' => 'edit',
                'model' => 'user',
                'description' => 'Edit users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:06:03',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'user_delete',
                'display_name' => 'delete',
                'model' => 'user',
                'description' => 'Delete users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:06:13',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'user_show',
                'display_name' => 'show',
                'model' => 'user',
                'description' => 'View users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:06:24',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'post_browse',
                'display_name' => 'browse',
                'model' => 'post',
                'description' => 'Browse all posts',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 16:50:28',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'post_add',
                'display_name' => 'add',
                'model' => 'post',
                'description' => 'Add a post',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 16:50:20',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'post_edit',
                'display_name' => 'edit',
                'model' => 'post',
                'description' => 'Edit all posts',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 16:50:42',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'post_delete',
                'display_name' => 'delete',
                'model' => 'post',
                'description' => 'Delete all posts',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 16:50:52',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'post_read',
                'display_name' => 'read',
                'model' => 'post',
                'description' => 'View a post',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 16:51:02',
            ),
            15 => 
            array (
                'id' => 21,
                'name' => 'change_user_pwd',
                'display_name' => 'Change User PWD',
                'model' => 'user',
                'description' => 'Change another member\'s password',
                'created_at' => '2018-11-26 15:15:18',
                'updated_at' => '2018-11-28 16:55:31',
            ),
            16 => 
            array (
                'id' => 24,
                'name' => 'invoicer_index',
                'display_name' => 'index',
                'model' => 'invoicer',
                'description' => 'View the invoicer module',
                'created_at' => '2018-11-26 15:46:46',
                'updated_at' => '2018-11-28 16:55:45',
            ),
            17 => 
            array (
                'id' => 25,
                'name' => 'invoicer_client_index',
                'display_name' => 'Client Index',
                'model' => 'invoicer',
                'description' => 'Access the invoicer module client list',
                'created_at' => '2018-11-26 15:47:42',
                'updated_at' => '2018-11-28 16:55:55',
            ),
            18 => 
            array (
                'id' => 26,
                'name' => 'invoicer_dashboard',
                'display_name' => 'dashboard',
                'model' => 'invoicer',
                'description' => 'Access the Invoicer module dashboard',
                'created_at' => '2018-11-27 13:57:35',
                'updated_at' => '2018-11-28 17:00:58',
            ),
            19 => 
            array (
                'id' => 27,
                'name' => 'invoicer_ledger',
                'display_name' => 'ledger',
                'model' => 'invoicer',
                'description' => 'Allow member to access the Invoicer ledger',
                'created_at' => '2018-11-27 14:15:39',
                'updated_at' => '2018-11-27 14:15:39',
            ),
            20 => 
            array (
                'id' => 28,
                'name' => 'invoicer_client_create',
                'display_name' => 'Client Create',
                'model' => 'invoicer',
                'description' => 'Create new clients in the Invoicer module',
                'created_at' => '2018-11-27 17:19:07',
                'updated_at' => '2018-11-28 17:01:20',
            ),
            21 => 
            array (
                'id' => 29,
                'name' => 'invoicer_client_show',
                'display_name' => 'Client show',
                'model' => 'invoicer',
                'description' => 'View clients in Invoicer module',
                'created_at' => '2018-11-27 17:20:11',
                'updated_at' => '2018-11-28 17:02:03',
            ),
            22 => 
            array (
                'id' => 30,
                'name' => 'invoicer_client_edit',
                'display_name' => 'Client Edit',
                'model' => 'invoicer',
                'description' => 'Edit clients in the Invoicer module',
                'created_at' => '2018-11-27 17:21:02',
                'updated_at' => '2018-11-28 17:02:15',
            ),
            23 => 
            array (
                'id' => 31,
                'name' => 'invoicer_client_delete',
                'display_name' => 'Client Delete',
                'model' => 'invoicer',
                'description' => 'Delete clients in the Invoicer module',
                'created_at' => '2018-11-27 17:21:45',
                'updated_at' => '2018-11-28 17:04:16',
            ),
            24 => 
            array (
                'id' => 32,
                'name' => 'invoicer_invoice_index',
                'display_name' => 'Invoice index',
                'model' => 'invoicer',
                'description' => 'Display invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:13:26',
                'updated_at' => '2018-11-28 17:04:28',
            ),
            25 => 
            array (
                'id' => 33,
                'name' => 'invoicer_invoice_create',
                'display_name' => 'Invoice Create',
                'model' => 'invoicer',
                'description' => 'Create invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:18:50',
                'updated_at' => '2018-11-28 17:06:47',
            ),
            26 => 
            array (
                'id' => 34,
                'name' => 'invoicer_invoice_edit',
                'display_name' => 'Invoice edit',
                'model' => 'invoicer',
                'description' => 'Edit invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:19:17',
                'updated_at' => '2018-11-28 17:06:56',
            ),
            27 => 
            array (
                'id' => 35,
                'name' => 'invoicer_invoice_delete',
                'display_name' => 'Invoice delete',
                'model' => 'invoicer',
                'description' => 'Delete invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:19:44',
                'updated_at' => '2018-11-28 17:07:03',
            ),
            28 => 
            array (
                'id' => 36,
                'name' => 'invoicer_invoice_show',
                'display_name' => 'Invoice show',
                'model' => 'invoicer',
                'description' => 'View invoices in the Invoicer module',
                'created_at' => '2018-11-28 14:34:09',
                'updated_at' => '2018-11-28 17:07:13',
            ),
            29 => 
            array (
                'id' => 37,
                'name' => 'invoicer_product_index',
                'display_name' => 'product index',
                'model' => 'invoicer',
                'description' => 'Allow member to list products in the Invoicer module',
                'created_at' => '2018-11-28 14:42:22',
                'updated_at' => '2018-11-28 14:42:22',
            ),
            30 => 
            array (
                'id' => 38,
                'name' => 'invoicer_product_create',
                'display_name' => 'product create',
                'model' => 'invoicer',
                'description' => 'Create products in the Invoicer module',
                'created_at' => '2018-11-28 14:43:05',
                'updated_at' => '2018-11-28 17:07:23',
            ),
            31 => 
            array (
                'id' => 39,
                'name' => 'invoicer_product_edit',
                'display_name' => 'product edit',
                'model' => 'invoicer',
                'description' => 'Edit products in the Invoicer module',
                'created_at' => '2018-11-28 14:43:33',
                'updated_at' => '2018-11-28 17:07:36',
            ),
            32 => 
            array (
                'id' => 40,
                'name' => 'invoicer_product_show',
                'display_name' => 'product show',
                'model' => 'invoicer',
                'description' => 'View products in the Invoicer module',
                'created_at' => '2018-11-28 14:44:02',
                'updated_at' => '2018-11-28 17:07:47',
            ),
            33 => 
            array (
                'id' => 41,
                'name' => 'invoicer_product_delete',
                'display_name' => 'product delete',
                'model' => 'invoicer',
                'description' => 'Delete products in the Invoicer module',
                'created_at' => '2018-11-28 14:44:23',
                'updated_at' => '2018-11-28 17:08:00',
            ),
            34 => 
            array (
                'id' => 47,
                'name' => 'admin_menu',
                'display_name' => 'admin menu',
                'model' => 'admin',
                'description' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 52,
                'name' => 'category_browse',
                'display_name' => 'browse',
                'model' => 'category',
                'description' => 'list categories',
                'created_at' => '2018-12-03 15:02:47',
                'updated_at' => '2018-12-03 15:02:47',
            ),
            36 => 
            array (
                'id' => 53,
                'name' => 'category_add',
                'display_name' => 'add',
                'model' => 'category',
                'description' => 'create categories',
                'created_at' => '2018-12-03 15:04:11',
                'updated_at' => '2018-12-03 15:04:11',
            ),
            37 => 
            array (
                'id' => 54,
                'name' => 'category_edit',
                'display_name' => 'edit',
                'model' => 'category',
                'description' => 'edit categories',
                'created_at' => '2018-12-03 16:53:16',
                'updated_at' => '2018-12-03 16:53:16',
            ),
            38 => 
            array (
                'id' => 55,
                'name' => 'category_delete',
                'display_name' => 'delete',
                'model' => 'category',
                'description' => 'delete categories',
                'created_at' => '2018-12-03 16:53:48',
                'updated_at' => '2018-12-03 16:53:48',
            ),
            39 => 
            array (
                'id' => 56,
                'name' => 'category_read',
                'display_name' => 'show',
                'model' => 'category',
                'description' => 'show category',
                'created_at' => '2018-12-03 17:36:32',
                'updated_at' => '2018-12-03 17:36:32',
            ),
            40 => 
            array (
                'id' => 57,
                'name' => 'article_index',
                'display_name' => 'Index',
                'model' => 'Article',
                'description' => 'List articles',
                'created_at' => '2019-04-08 08:46:02',
                'updated_at' => '2019-04-08 08:46:02',
            ),
            41 => 
            array (
                'id' => 58,
                'name' => 'recipe_edit',
                'display_name' => 'Edit',
                'model' => 'recipe',
                'description' => 'edit all recipes',
                'created_at' => '2019-05-15 10:28:03',
                'updated_at' => '2019-05-15 10:28:03',
            ),
            42 => 
            array (
                'id' => 59,
                'name' => 'recipe_publish',
                'display_name' => 'Publish',
                'model' => 'recipe',
                'description' => 'publish / unpublish recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            43 => 
            array (
                'id' => 60,
                'name' => 'recipe_published',
                'display_name' => 'Published',
                'model' => 'recipe',
                'description' => 'view published / unpublished recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            44 => 
            array (
                'id' => 61,
                'name' => 'recipe_private',
                'display_name' => 'Private/Public',
                'model' => 'recipe',
                'description' => 'hide or show his recipes to the general public',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            45 => 
            array (
                'id' => 62,
                'name' => 'recipe_create',
                'display_name' => 'Create',
                'model' => 'recipe',
                'description' => 'create recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            46 => 
            array (
                'id' => 63,
                'name' => 'recipe_new',
                'display_name' => 'New',
                'model' => 'recipe',
                'description' => 'view new recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            47 => 
            array (
                'id' => 64,
                'name' => 'recipe_future',
                'display_name' => 'Future',
                'model' => 'recipe',
                'description' => 'view future recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            48 => 
            array (
                'id' => 65,
                'name' => 'comment_add',
                'display_name' => 'add',
                'model' => 'comment',
                'description' => 'add comments to items on the site',
                'created_at' => '2019-06-10 13:17:15',
                'updated_at' => '2019-06-10 13:17:15',
            ),
            49 => 
            array (
                'id' => 166,
                'name' => 'projects_index',
                'display_name' => 'index',
                'model' => 'project',
                'description' => 'list projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 167,
                'name' => 'projects_create',
                'display_name' => 'create',
                'model' => 'project',
                'description' => 'create projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 168,
                'name' => 'projects_edit',
                'display_name' => 'edit',
                'model' => 'project',
                'description' => 'edit projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 169,
                'name' => 'projects_show',
                'display_name' => 'show',
                'model' => 'project',
                'description' => 'view projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 170,
                'name' => 'projects_delete',
                'display_name' => 'delete',
                'model' => 'project',
                'description' => 'delete projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 192,
                'name' => 'comment_browse',
                'display_name' => 'browse',
                'model' => 'comment',
                'description' => 'list comments',
                'created_at' => '2019-09-02 07:28:14',
                'updated_at' => '2019-09-02 07:28:14',
            ),
            56 => 
            array (
                'id' => 193,
                'name' => 'comment_edit',
                'display_name' => 'edit',
                'model' => 'comment',
                'description' => 'edit comments',
                'created_at' => '2019-09-02 07:33:29',
                'updated_at' => '2019-09-02 07:33:29',
            ),
            57 => 
            array (
                'id' => 194,
                'name' => 'comment_delete',
                'display_name' => 'delete',
                'model' => 'comment',
                'description' => 'delete comments',
                'created_at' => '2019-09-02 07:34:30',
                'updated_at' => '2019-09-02 07:34:30',
            ),
        ));
        
        
    }
}