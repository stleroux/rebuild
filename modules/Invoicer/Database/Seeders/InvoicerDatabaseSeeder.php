<?php

namespace Modules\Invoicer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $this->call(InvoicerInvoiceitemsTableSeeder::class);
    }
}
