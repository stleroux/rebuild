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
                'name' => 'permission_browse',
                'display_name' => 'browse',
                'model' => 'permission',
                'description' => 'List permissions',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:04:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'permission_add',
                'display_name' => 'add',
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
                'name' => 'permission_read',
                'display_name' => 'read',
                'model' => 'permission',
                'description' => 'View permission',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'user_browse',
                'display_name' => 'browse',
                'model' => 'user',
                'description' => 'List users',
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:05:41',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'user_add',
                'display_name' => 'add',
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
                'name' => 'user_read',
                'display_name' => 'read',
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
                'id' => 24,
                'name' => 'invoicer_index',
                'display_name' => 'index',
                'model' => 'invoicer',
                'description' => 'View the invoicer module',
                'created_at' => '2018-11-26 15:46:46',
                'updated_at' => '2018-11-28 16:55:45',
            ),
            16 => 
            array (
                'id' => 25,
                'name' => 'invoicer_client_index',
                'display_name' => 'Client Index',
                'model' => 'invoicer',
                'description' => 'Access the invoicer module client list',
                'created_at' => '2018-11-26 15:47:42',
                'updated_at' => '2018-11-28 16:55:55',
            ),
            17 => 
            array (
                'id' => 26,
                'name' => 'invoicer_dashboard',
                'display_name' => 'dashboard',
                'model' => 'invoicer',
                'description' => 'Access the Invoicer module dashboard',
                'created_at' => '2018-11-27 13:57:35',
                'updated_at' => '2018-11-28 17:00:58',
            ),
            18 => 
            array (
                'id' => 27,
                'name' => 'invoicer_ledger',
                'display_name' => 'ledger',
                'model' => 'invoicer',
                'description' => 'Allow member to access the Invoicer ledger',
                'created_at' => '2018-11-27 14:15:39',
                'updated_at' => '2018-11-27 14:15:39',
            ),
            19 => 
            array (
                'id' => 28,
                'name' => 'invoicer_client_create',
                'display_name' => 'Client Create',
                'model' => 'invoicer',
                'description' => 'Create new clients in the Invoicer module',
                'created_at' => '2018-11-27 17:19:07',
                'updated_at' => '2018-11-28 17:01:20',
            ),
            20 => 
            array (
                'id' => 29,
                'name' => 'invoicer_client_show',
                'display_name' => 'Client show',
                'model' => 'invoicer',
                'description' => 'View clients in Invoicer module',
                'created_at' => '2018-11-27 17:20:11',
                'updated_at' => '2018-11-28 17:02:03',
            ),
            21 => 
            array (
                'id' => 30,
                'name' => 'invoicer_client_edit',
                'display_name' => 'Client Edit',
                'model' => 'invoicer',
                'description' => 'Edit clients in the Invoicer module',
                'created_at' => '2018-11-27 17:21:02',
                'updated_at' => '2018-11-28 17:02:15',
            ),
            22 => 
            array (
                'id' => 31,
                'name' => 'invoicer_client_delete',
                'display_name' => 'Client Delete',
                'model' => 'invoicer',
                'description' => 'Delete clients in the Invoicer module',
                'created_at' => '2018-11-27 17:21:45',
                'updated_at' => '2018-11-28 17:04:16',
            ),
            23 => 
            array (
                'id' => 32,
                'name' => 'invoicer_invoice_index',
                'display_name' => 'Invoice index',
                'model' => 'invoicer',
                'description' => 'Display invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:13:26',
                'updated_at' => '2018-11-28 17:04:28',
            ),
            24 => 
            array (
                'id' => 33,
                'name' => 'invoicer_invoice_create',
                'display_name' => 'Invoice Create',
                'model' => 'invoicer',
                'description' => 'Create invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:18:50',
                'updated_at' => '2018-11-28 17:06:47',
            ),
            25 => 
            array (
                'id' => 34,
                'name' => 'invoicer_invoice_edit',
                'display_name' => 'Invoice edit',
                'model' => 'invoicer',
                'description' => 'Edit invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:19:17',
                'updated_at' => '2018-11-28 17:06:56',
            ),
            26 => 
            array (
                'id' => 35,
                'name' => 'invoicer_invoice_delete',
                'display_name' => 'Invoice delete',
                'model' => 'invoicer',
                'description' => 'Delete invoices in the Invoicer module',
                'created_at' => '2018-11-27 20:19:44',
                'updated_at' => '2018-11-28 17:07:03',
            ),
            27 => 
            array (
                'id' => 36,
                'name' => 'invoicer_invoice_show',
                'display_name' => 'Invoice show',
                'model' => 'invoicer',
                'description' => 'View invoices in the Invoicer module',
                'created_at' => '2018-11-28 14:34:09',
                'updated_at' => '2018-11-28 17:07:13',
            ),
            28 => 
            array (
                'id' => 37,
                'name' => 'invoicer_product_index',
                'display_name' => 'product index',
                'model' => 'invoicer',
                'description' => 'Allow member to list products in the Invoicer module',
                'created_at' => '2018-11-28 14:42:22',
                'updated_at' => '2018-11-28 14:42:22',
            ),
            29 => 
            array (
                'id' => 38,
                'name' => 'invoicer_product_create',
                'display_name' => 'product create',
                'model' => 'invoicer',
                'description' => 'Create products in the Invoicer module',
                'created_at' => '2018-11-28 14:43:05',
                'updated_at' => '2018-11-28 17:07:23',
            ),
            30 => 
            array (
                'id' => 39,
                'name' => 'invoicer_product_edit',
                'display_name' => 'product edit',
                'model' => 'invoicer',
                'description' => 'Edit products in the Invoicer module',
                'created_at' => '2018-11-28 14:43:33',
                'updated_at' => '2018-11-28 17:07:36',
            ),
            31 => 
            array (
                'id' => 40,
                'name' => 'invoicer_product_show',
                'display_name' => 'product show',
                'model' => 'invoicer',
                'description' => 'View products in the Invoicer module',
                'created_at' => '2018-11-28 14:44:02',
                'updated_at' => '2018-11-28 17:07:47',
            ),
            32 => 
            array (
                'id' => 41,
                'name' => 'invoicer_product_delete',
                'display_name' => 'product delete',
                'model' => 'invoicer',
                'description' => 'Delete products in the Invoicer module',
                'created_at' => '2018-11-28 14:44:23',
                'updated_at' => '2018-11-28 17:08:00',
            ),
            33 => 
            array (
                'id' => 47,
                'name' => 'admin_menu',
                'display_name' => 'admin menu',
                'model' => 'admin',
                'description' => '',
                'created_at' => NULL,
                'updated_at' => '2019-09-06 05:49:23',
            ),
            34 => 
            array (
                'id' => 52,
                'name' => 'category_browse',
                'display_name' => 'browse',
                'model' => 'category',
                'description' => 'list categories',
                'created_at' => '2018-12-03 15:02:47',
                'updated_at' => '2018-12-03 15:02:47',
            ),
            35 => 
            array (
                'id' => 53,
                'name' => 'category_add',
                'display_name' => 'add',
                'model' => 'category',
                'description' => 'create categories',
                'created_at' => '2018-12-03 15:04:11',
                'updated_at' => '2018-12-03 15:04:11',
            ),
            36 => 
            array (
                'id' => 54,
                'name' => 'category_edit',
                'display_name' => 'edit',
                'model' => 'category',
                'description' => 'edit categories',
                'created_at' => '2018-12-03 16:53:16',
                'updated_at' => '2018-12-03 16:53:16',
            ),
            37 => 
            array (
                'id' => 55,
                'name' => 'category_delete',
                'display_name' => 'delete',
                'model' => 'category',
                'description' => 'delete categories',
                'created_at' => '2018-12-03 16:53:48',
                'updated_at' => '2018-12-03 16:53:48',
            ),
            38 => 
            array (
                'id' => 56,
                'name' => 'category_read',
                'display_name' => 'read',
                'model' => 'category',
                'description' => 'show category',
                'created_at' => '2018-12-03 17:36:32',
                'updated_at' => '2018-12-03 17:36:32',
            ),
            39 => 
            array (
                'id' => 58,
                'name' => 'recipe_browse',
                'display_name' => 'browse',
                'model' => 'recipe',
                'description' => 'List recipes',
                'created_at' => '2019-05-15 10:28:03',
                'updated_at' => '2019-05-15 10:28:03',
            ),
            40 => 
            array (
                'id' => 59,
                'name' => 'recipe_read',
                'display_name' => 'read',
                'model' => 'recipe',
                'description' => 'read recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            41 => 
            array (
                'id' => 60,
                'name' => 'recipe_edit',
                'display_name' => 'edit',
                'model' => 'recipe',
                'description' => 'edit recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            42 => 
            array (
                'id' => 61,
                'name' => 'recipe_add',
                'display_name' => 'add',
                'model' => 'recipe',
                'description' => 'add recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            43 => 
            array (
                'id' => 62,
                'name' => 'recipe_delete',
                'display_name' => 'delete',
                'model' => 'recipe',
                'description' => 'delete recipes',
                'created_at' => '2019-05-28 11:44:34',
                'updated_at' => '2019-05-28 11:44:34',
            ),
            44 => 
            array (
                'id' => 65,
                'name' => 'comment_add',
                'display_name' => 'add',
                'model' => 'comment',
                'description' => 'add comments to items on the site',
                'created_at' => '2019-06-10 13:17:15',
                'updated_at' => '2019-06-10 13:17:15',
            ),
            45 => 
            array (
                'id' => 166,
                'name' => 'projects_browse',
                'display_name' => 'browse',
                'model' => 'project',
                'description' => 'list projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 167,
                'name' => 'projects_add',
                'display_name' => 'add',
                'model' => 'project',
                'description' => 'create projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 168,
                'name' => 'projects_edit',
                'display_name' => 'edit',
                'model' => 'project',
                'description' => 'edit projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 169,
                'name' => 'projects_read',
                'display_name' => 'read',
                'model' => 'project',
                'description' => 'view projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 170,
                'name' => 'projects_delete',
                'display_name' => 'delete',
                'model' => 'project',
                'description' => 'delete projects',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 192,
                'name' => 'comment_browse',
                'display_name' => 'browse',
                'model' => 'comment',
                'description' => 'list comments',
                'created_at' => '2019-09-02 07:28:14',
                'updated_at' => '2019-09-02 07:28:14',
            ),
            51 => 
            array (
                'id' => 193,
                'name' => 'comment_edit',
                'display_name' => 'edit',
                'model' => 'comment',
                'description' => 'edit comments',
                'created_at' => '2019-09-02 07:33:29',
                'updated_at' => '2019-09-02 07:33:29',
            ),
            52 => 
            array (
                'id' => 194,
                'name' => 'comment_delete',
                'display_name' => 'delete',
                'model' => 'comment',
                'description' => 'delete comments',
                'created_at' => '2019-09-02 07:34:30',
                'updated_at' => '2019-09-02 07:34:30',
            ),
            53 => 
            array (
                'id' => 195,
                'name' => 'article_browse',
                'display_name' => 'Browse',
                'model' => 'article',
                'description' => 'browse article',
                'created_at' => '2019-10-27 06:08:55',
                'updated_at' => '2019-10-27 06:08:55',
            ),
            54 => 
            array (
                'id' => 196,
                'name' => 'article_read',
                'display_name' => 'Read',
                'model' => 'article',
                'description' => 'read article',
                'created_at' => '2019-10-27 06:08:55',
                'updated_at' => '2019-10-27 06:08:55',
            ),
            55 => 
            array (
                'id' => 197,
                'name' => 'article_edit',
                'display_name' => 'Edit',
                'model' => 'article',
                'description' => 'edit article',
                'created_at' => '2019-10-27 06:08:55',
                'updated_at' => '2019-10-27 06:08:55',
            ),
            56 => 
            array (
                'id' => 198,
                'name' => 'article_add',
                'display_name' => 'Add',
                'model' => 'article',
                'description' => 'add article',
                'created_at' => '2019-10-27 06:08:55',
                'updated_at' => '2019-10-27 06:08:55',
            ),
            57 => 
            array (
                'id' => 199,
                'name' => 'article_delete',
                'display_name' => 'Delete',
                'model' => 'article',
                'description' => 'delete article',
                'created_at' => '2019-10-27 06:08:55',
                'updated_at' => '2019-10-27 06:08:55',
            ),
            58 => 
            array (
                'id' => 200,
                'name' => 'dart_browse',
                'display_name' => 'Browse',
                'model' => 'dart',
                'description' => 'browse dart',
                'created_at' => '2019-12-06 08:19:15',
                'updated_at' => '2019-12-06 08:19:15',
            ),
            59 => 
            array (
                'id' => 201,
                'name' => 'dart_read',
                'display_name' => 'Read',
                'model' => 'dart',
                'description' => 'read dart',
                'created_at' => '2019-12-06 08:19:15',
                'updated_at' => '2019-12-06 08:19:15',
            ),
            60 => 
            array (
                'id' => 202,
                'name' => 'dart_edit',
                'display_name' => 'Edit',
                'model' => 'dart',
                'description' => 'edit dart',
                'created_at' => '2019-12-06 08:19:15',
                'updated_at' => '2019-12-06 08:19:15',
            ),
            61 => 
            array (
                'id' => 203,
                'name' => 'dart_add',
                'display_name' => 'Add',
                'model' => 'dart',
                'description' => 'add dart',
                'created_at' => '2019-12-06 08:19:15',
                'updated_at' => '2019-12-06 08:19:15',
            ),
            62 => 
            array (
                'id' => 204,
                'name' => 'dart_delete',
                'display_name' => 'Delete',
                'model' => 'dart',
                'description' => 'delete dart',
                'created_at' => '2019-12-06 08:19:15',
                'updated_at' => '2019-12-06 08:19:15',
            ),
        ));
        
        
    }
}