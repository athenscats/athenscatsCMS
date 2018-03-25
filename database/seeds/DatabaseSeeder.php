<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       // Disable all mass assignment restrictions
  
         $this->call(RolesAndPermissionsSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CategoriesSeeder::class);
         $this->call(PostsTableSeeder::class);
         // Re enable all mass assignment restrictions

    }
}
