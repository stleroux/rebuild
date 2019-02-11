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
        $this->call(ModulesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionUserTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
    }
}
