<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = App\User::create([
            'name' => 'Eric',
            'email' => 'athenscatsgr@gmail.com',
            'password' => 'Avincito13'
        ]);
        $user->assignRole('owner');

        $user = App\User::create([
            'name' => 'Bonanza',
            'email' => 'bonanza@gmail.com',
            'password' => 'Bonanza'
        ]);
        $user->assignRole('Moderator');

        $user = App\User::create([
            'name' => 'Navarhos',
            'email' => 'navarhos@gmail.com',
            'password' => 'Navarhos'
        ]);
        $user->assignRole('Writer');

        $user = App\User::create([
            'name' => 'simpleuser',
            'email' => 'simpleuser@gmail.com',
            'password' => 'simpleuser'
        ]);
        $user->assignRole('User');
    }
}
