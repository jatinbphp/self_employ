<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Data & IT', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Build & Renovate', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Moving & Transport', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Land & Plot', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Settlement', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Photo & Image', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Marketing', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
        Category::create(['name' => 'Others', 'image' => 'default.png', 'icon' => 'fa fa-icon', 'status' => 'active']);
    }
}
