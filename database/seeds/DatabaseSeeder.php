<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UsersTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(ArticlesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(DartGamesTableSeeder::class);
        $this->call(DartPlayersTableSeeder::class);
        $this->call(DartScoresTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        
        $this->call(InvoicerClientsTableSeeder::class);
        $this->call(InvoicerInvoicesTableSeeder::class);
        $this->call(InvoicerProductsTableSeeder::class);
        $this->call(InvoicerInvoiceItemsTableSeeder::class);
        
        // $this->call(PasswordResetsTableSeeder::class);

        $this->call(PermissionUserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        
        $this->call(ProjectsFinishesTableSeeder::class);
        $this->call(ProjectsMaterialsTableSeeder::class);
        $this->call(ProjectsProjectsTableSeeder::class);
        $this->call(ProjectsImagesTableSeeder::class);
        $this->call(ProjectsFinishProjectTableSeeder::class);
        $this->call(ProjectsMaterialProjectTableSeeder::class);
        
        $this->call(RecipeUserTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        
        $this->call(SettingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
    }
}

