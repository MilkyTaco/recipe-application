<?php

namespace Database\Seeders;

use App\Models\Categories;
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
        Categories::insert([[
            'name' => 'Main course'
        ], [
            'name' => 'Appetizer'
        ], [
            'name' => 'Dessert'
        ], [
            'name' => 'Soup'
        ], [
            'name' => 'Drinks'
        ]]); 
    }
}
