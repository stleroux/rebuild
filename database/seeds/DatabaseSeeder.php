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
        $this->call(SettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionUserTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(RecipeUserTableSeeder::class);
        $this->call(Projects-finishesTableSeeder::class);
        $this->call(Projects-finishProjectTableSeeder::class);
        $this->call(Projects-imagesTableSeeder::class);
        $this->call(Projects-materialsTableSeeder::class);
        $this->call(Projects-materialProjectTableSeeder::class);
        $this->call(Projects-projectsTableSeeder::class);
    }
}
