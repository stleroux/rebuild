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
                'created_at' => NULL,
                'description' => 'List permissions',
                'display_name' => 'index',
                'id' => 1,
                'model' => 'permission',
                'name' => 'permission_index',
                'type' => 1,
                'updated_at' => '2018-11-28 17:04:45',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'description' => 'Create and store permissions',
                'display_name' => 'create',
                'id' => 2,
                'model' => 'permission',
                'name' => 'permission_create',
                'type' => 1,
                'updated_at' => '2018-11-28 17:04:54',
            ),
            2 => 
            array (
                'created_at' => NULL,
                'description' => 'Edit permissions',
                'display_name' => 'edit',
                'id' => 3,
                'model' => 'permission',
                'name' => 'permission_edit',
                'type' => 1,
                'updated_at' => '2018-11-28 17:05:08',
            ),
            3 => 
            array (
                'created_at' => NULL,
                'description' => 'Delete permissions',
                'display_name' => 'delete',
                'id' => 4,
                'model' => 'permission',
                'name' => 'permission_delete',
                'type' => 1,
                'updated_at' => '2018-11-28 17:05:15',
            ),
            4 => 
            array (
                'created_at' => NULL,
                'description' => 'View permission',
                'display_name' => 'show',
                'id' => 5,
                'model' => 'permission',
                'name' => 'permission_show',
                'type' => 1,
                'updated_at' => '2018-11-28 17:05:32',
            ),
            5 => 
            array (
                'created_at' => NULL,
                'description' => 'List users',
                'display_name' => 'index',
                'id' => 6,
                'model' => 'user',
                'name' => 'user_index',
                'type' => 1,
                'updated_at' => '2018-11-28 17:05:41',
            ),
            6 => 
            array (
                'created_at' => NULL,
                'description' => 'Create users',
                'display_name' => 'create',
                'id' => 7,
                'model' => 'user',
                'name' => 'user_create',
                'type' => 1,
                'updated_at' => '2018-11-28 17:05:53',
            ),
            7 => 
            array (
                'created_at' => NULL,
                'description' => 'Edit users',
                'display_name' => 'edit',
                'id' => 8,
                'model' => 'user',
                'name' => 'user_edit',
                'type' => 1,
                'updated_at' => '2018-11-28 17:06:03',
            ),
            8 => 
            array (
                'created_at' => NULL,
                'description' => 'Delete users',
                'display_name' => 'delete',
                'id' => 9,
                'model' => 'user',
                'name' => 'user_delete',
                'type' => 1,
                'updated_at' => '2018-11-28 17:06:13',
            ),
            9 => 
            array (
                'created_at' => NULL,
                'description' => 'View users',
                'display_name' => 'show',
                'id' => 10,
                'model' => 'user',
                'name' => 'user_show',
                'type' => 1,
                'updated_at' => '2018-11-28 17:06:24',
            ),
            10 => 
            array (
                'created_at' => NULL,
                'description' => 'List posts',
                'display_name' => 'index',
                'id' => 11,
                'model' => 'post',
                'name' => 'post_index',
                'type' => 2,
                'updated_at' => '2018-11-28 16:50:28',
            ),
            11 => 
            array (
                'created_at' => NULL,
                'description' => 'Save posts',
                'display_name' => 'create',
                'id' => 12,
                'model' => 'post',
                'name' => 'post_create',
                'type' => 2,
                'updated_at' => '2018-11-28 16:50:20',
            ),
            12 => 
            array (
                'created_at' => NULL,
                'description' => 'Edit posts',
                'display_name' => 'edit',
                'id' => 13,
                'model' => 'post',
                'name' => 'post_edit',
                'type' => 2,
                'updated_at' => '2018-11-28 16:50:42',
            ),
            13 => 
            array (
                'created_at' => NULL,
                'description' => 'Delete posts',
                'display_name' => 'delete',
                'id' => 14,
                'model' => 'post',
                'name' => 'post_delete',
                'type' => 2,
                'updated_at' => '2018-11-28 16:50:52',
            ),
            14 => 
            array (
                'created_at' => NULL,
                'description' => 'View posts',
                'display_name' => 'show',
                'id' => 15,
                'model' => 'post',
                'name' => 'post_show',
                'type' => 2,
                'updated_at' => '2018-11-28 16:51:02',
            ),
            15 => 
            array (
                'created_at' => '2018-11-26 14:37:41',
                'description' => 'List components',
                'display_name' => 'Index',
                'id' => 16,
                'model' => 'component',
                'name' => 'component_index',
                'type' => 1,
                'updated_at' => '2018-11-28 16:52:00',
            ),
            16 => 
            array (
                'created_at' => '2018-11-26 14:45:03',
                'description' => 'Create components',
                'display_name' => 'create',
                'id' => 17,
                'model' => 'component',
                'name' => 'component_create',
                'type' => 1,
                'updated_at' => '2018-11-28 16:52:19',
            ),
            17 => 
            array (
                'created_at' => '2018-11-26 14:46:16',
                'description' => 'Enable a component',
                'display_name' => 'enable',
                'id' => 18,
                'model' => 'component',
                'name' => 'component_enable',
                'type' => 1,
                'updated_at' => '2018-11-28 16:53:14',
            ),
            18 => 
            array (
                'created_at' => '2018-11-26 14:46:44',
                'description' => 'Disable a component',
                'display_name' => 'disable',
                'id' => 19,
                'model' => 'component',
                'name' => 'component_disable',
                'type' => 1,
                'updated_at' => '2018-11-28 16:53:24',
            ),
            19 => 
            array (
                'created_at' => '2018-11-26 14:47:24',
                'description' => 'Delete components',
                'display_name' => 'delete',
                'id' => 20,
                'model' => 'component',
                'name' => 'component_delete',
                'type' => 1,
                'updated_at' => '2018-11-28 16:53:37',
            ),
            20 => 
            array (
                'created_at' => '2018-11-26 15:15:18',
                'description' => 'Change another member\'s password',
                'display_name' => 'Change User PWD',
                'id' => 21,
                'model' => 'user',
                'name' => 'change_user_pwd',
                'type' => 1,
                'updated_at' => '2018-11-28 16:55:31',
            ),
            21 => 
            array (
                'created_at' => '2018-11-26 15:46:46',
                'description' => 'View the invoicer module',
                'display_name' => 'index',
                'id' => 24,
                'model' => 'invoicer',
                'name' => 'invoicer_index',
                'type' => 2,
                'updated_at' => '2018-11-28 16:55:45',
            ),
            22 => 
            array (
                'created_at' => '2018-11-26 15:47:42',
                'description' => 'Access the invoicer module client list',
                'display_name' => 'Client Index',
                'id' => 25,
                'model' => 'invoicer',
                'name' => 'invoicer_client_index',
                'type' => 2,
                'updated_at' => '2018-11-28 16:55:55',
            ),
            23 => 
            array (
                'created_at' => '2018-11-27 13:57:35',
                'description' => 'Access the Invoicer module dashboard',
                'display_name' => 'dashboard',
                'id' => 26,
                'model' => 'invoicer',
                'name' => 'invoicer_dashboard',
                'type' => 2,
                'updated_at' => '2018-11-28 17:00:58',
            ),
            24 => 
            array (
                'created_at' => '2018-11-27 14:15:39',
                'description' => 'Allow member to access the Invoicer ledger',
                'display_name' => 'ledger',
                'id' => 27,
                'model' => 'invoicer',
                'name' => 'invoicer_ledger',
                'type' => 2,
                'updated_at' => '2018-11-27 14:15:39',
            ),
            25 => 
            array (
                'created_at' => '2018-11-27 17:19:07',
                'description' => 'Create new clients in the Invoicer module',
                'display_name' => 'Client Create',
                'id' => 28,
                'model' => 'invoicer',
                'name' => 'invoicer_client_create',
                'type' => 2,
                'updated_at' => '2018-11-28 17:01:20',
            ),
            26 => 
            array (
                'created_at' => '2018-11-27 17:20:11',
                'description' => 'View clients in Invoicer module',
                'display_name' => 'Client show',
                'id' => 29,
                'model' => 'invoicer',
                'name' => 'invoicer_client_show',
                'type' => 2,
                'updated_at' => '2018-11-28 17:02:03',
            ),
            27 => 
            array (
                'created_at' => '2018-11-27 17:21:02',
                'description' => 'Edit clients in the Invoicer module',
                'display_name' => 'Client Edit',
                'id' => 30,
                'model' => 'invoicer',
                'name' => 'invoicer_client_edit',
                'type' => 2,
                'updated_at' => '2018-11-28 17:02:15',
            ),
            28 => 
            array (
                'created_at' => '2018-11-27 17:21:45',
                'description' => 'Delete clients in the Invoicer module',
                'display_name' => 'Client Delete',
                'id' => 31,
                'model' => 'invoicer',
                'name' => 'invoicer_client_delete',
                'type' => 2,
                'updated_at' => '2018-11-28 17:04:16',
            ),
            29 => 
            array (
                'created_at' => '2018-11-27 20:13:26',
                'description' => 'Display invoices in the Invoicer module',
                'display_name' => 'Invoice index',
                'id' => 32,
                'model' => 'invoicer',
                'name' => 'invoicer_invoice_index',
                'type' => 2,
                'updated_at' => '2018-11-28 17:04:28',
            ),
            30 => 
            array (
                'created_at' => '2018-11-27 20:18:50',
                'description' => 'Create invoices in the Invoicer module',
                'display_name' => 'Invoice Create',
                'id' => 33,
                'model' => 'invoicer',
                'name' => 'invoicer_invoice_create',
                'type' => 2,
                'updated_at' => '2018-11-28 17:06:47',
            ),
            31 => 
            array (
                'created_at' => '2018-11-27 20:19:17',
                'description' => 'Edit invoices in the Invoicer module',
                'display_name' => 'Invoice edit',
                'id' => 34,
                'model' => 'invoicer',
                'name' => 'invoicer_invoice_edit',
                'type' => 2,
                'updated_at' => '2018-11-28 17:06:56',
            ),
            32 => 
            array (
                'created_at' => '2018-11-27 20:19:44',
                'description' => 'Delete invoices in the Invoicer module',
                'display_name' => 'Invoice delete',
                'id' => 35,
                'model' => 'invoicer',
                'name' => 'invoicer_invoice_delete',
                'type' => 2,
                'updated_at' => '2018-11-28 17:07:03',
            ),
            33 => 
            array (
                'created_at' => '2018-11-28 14:34:09',
                'description' => 'View invoices in the Invoicer module',
                'display_name' => 'Invoice show',
                'id' => 36,
                'model' => 'invoicer',
                'name' => 'invoicer_invoice_show',
                'type' => 2,
                'updated_at' => '2018-11-28 17:07:13',
            ),
            34 => 
            array (
                'created_at' => '2018-11-28 14:42:22',
                'description' => 'Allow member to list products in the Invoicer module',
                'display_name' => 'product index',
                'id' => 37,
                'model' => 'invoicer',
                'name' => 'invoicer_product_index',
                'type' => 2,
                'updated_at' => '2018-11-28 14:42:22',
            ),
            35 => 
            array (
                'created_at' => '2018-11-28 14:43:05',
                'description' => 'Create products in the Invoicer module',
                'display_name' => 'product create',
                'id' => 38,
                'model' => 'invoicer',
                'name' => 'invoicer_product_create',
                'type' => 2,
                'updated_at' => '2018-11-28 17:07:23',
            ),
            36 => 
            array (
                'created_at' => '2018-11-28 14:43:33',
                'description' => 'Edit products in the Invoicer module',
                'display_name' => 'product edit',
                'id' => 39,
                'model' => 'invoicer',
                'name' => 'invoicer_product_edit',
                'type' => 2,
                'updated_at' => '2018-11-28 17:07:36',
            ),
            37 => 
            array (
                'created_at' => '2018-11-28 14:44:02',
                'description' => 'View products in the Invoicer module',
                'display_name' => 'product show',
                'id' => 40,
                'model' => 'invoicer',
                'name' => 'invoicer_product_show',
                'type' => 2,
                'updated_at' => '2018-11-28 17:07:47',
            ),
            38 => 
            array (
                'created_at' => '2018-11-28 14:44:23',
                'description' => 'Delete products in the Invoicer module',
                'display_name' => 'product delete',
                'id' => 41,
                'model' => 'invoicer',
                'name' => 'invoicer_product_delete',
                'type' => 2,
                'updated_at' => '2018-11-28 17:08:00',
            ),
            39 => 
            array (
                'created_at' => NULL,
                'description' => '',
                'display_name' => 'admin menu',
                'id' => 47,
                'model' => 'admin',
                'name' => 'admin_menu',
                'type' => 0,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => '2018-11-30 14:04:16',
                'description' => 'list modules',
                'display_name' => 'index',
                'id' => 48,
                'model' => 'module',
                'name' => 'module_index',
                'type' => 1,
                'updated_at' => '2018-11-30 14:04:16',
            ),
            41 => 
            array (
                'created_at' => '2018-11-30 15:37:02',
                'description' => 'create modules',
                'display_name' => 'create',
                'id' => 49,
                'model' => 'module',
                'name' => 'module_create',
                'type' => 1,
                'updated_at' => '2018-11-30 15:37:02',
            ),
            42 => 
            array (
                'created_at' => '2018-11-30 16:06:29',
                'description' => 'edit modules',
                'display_name' => 'edit',
                'id' => 50,
                'model' => 'module',
                'name' => 'module_edit',
                'type' => 1,
                'updated_at' => '2018-11-30 16:06:29',
            ),
            43 => 
            array (
                'created_at' => '2018-11-30 16:10:38',
                'description' => 'delete modules',
                'display_name' => 'delete',
                'id' => 51,
                'model' => 'module',
                'name' => 'module_delete',
                'type' => 1,
                'updated_at' => '2018-11-30 16:10:38',
            ),
            44 => 
            array (
                'created_at' => '2018-12-03 15:02:47',
                'description' => 'list categories',
                'display_name' => 'index',
                'id' => 52,
                'model' => 'categories',
                'name' => 'category_index',
                'type' => 1,
                'updated_at' => '2018-12-03 15:02:47',
            ),
            45 => 
            array (
                'created_at' => '2018-12-03 15:04:11',
                'description' => 'create categories',
                'display_name' => 'create',
                'id' => 53,
                'model' => 'categories',
                'name' => 'category_create',
                'type' => 1,
                'updated_at' => '2018-12-03 15:04:11',
            ),
            46 => 
            array (
                'created_at' => '2018-12-03 16:53:16',
                'description' => 'edit categories',
                'display_name' => 'edit',
                'id' => 54,
                'model' => 'categories',
                'name' => 'category_edit',
                'type' => 1,
                'updated_at' => '2018-12-03 16:53:16',
            ),
            47 => 
            array (
                'created_at' => '2018-12-03 16:53:48',
                'description' => 'delete categories',
                'display_name' => 'delete',
                'id' => 55,
                'model' => 'categories',
                'name' => 'category_delete',
                'type' => 1,
                'updated_at' => '2018-12-03 16:53:48',
            ),
            48 => 
            array (
                'created_at' => '2018-12-03 17:36:32',
                'description' => 'show category',
                'display_name' => 'show',
                'id' => 56,
                'model' => 'categories',
                'name' => 'category_show',
                'type' => 1,
                'updated_at' => '2018-12-03 17:36:32',
            ),
        ));
        
        
    }
}