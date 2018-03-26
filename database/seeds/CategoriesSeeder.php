<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Category::create([
            'name' => 'Travel',
        ]);
        App\Category::create([
            'name' => 'Moto GP',
        ]);
        App\Category::create([
            'name' => 'Web Development',
        ]);
        App\Category::create([
            'name' => 'Arduino',
        ]);
        App\Category::create([
            'name' => 'Raspberry Pi',
        ]);
        App\Category::create([
            'name' => 'Gaming',
        ]);
    }
}
