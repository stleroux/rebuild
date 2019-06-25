<?php

use Illuminate\Database\Seeder;

class InvoicerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(InvoicerClientsTableSeeder::class);
        $this->call(InvoicerProductsTableSeeder::class);
        $this->call(InvoicerInvoicesTableSeeder::class);
        $this->call(InvoicerInvoiceItemsTableSeeder::class);
    }
}
