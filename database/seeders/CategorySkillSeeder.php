<?php

namespace Database\Seeders;

use App\Models\CategorySkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategorySkill::create(['category_id' => 1, 'name' => 'Design & Development']);
        CategorySkill::create(['category_id' => 1, 'name' => 'Backend Development']);
        CategorySkill::create(['category_id' => 1, 'name' => 'Frontend Developement']);
        CategorySkill::create(['category_id' => 1, 'name' => 'Data Entry']);


        CategorySkill::create(['category_id' => 2, 'name' => 'Demolish']);
        CategorySkill::create(['category_id' => 2, 'name' => 'Concrette']);
        CategorySkill::create(['category_id' => 2, 'name' => 'Dumper']);
        CategorySkill::create(['category_id' => 2, 'name' => 'Loader']);

        CategorySkill::create(['category_id' => 3, 'name' => 'Mobil Services']);
        CategorySkill::create(['category_id' => 3, 'name' => 'Delivery']);
        CategorySkill::create(['category_id' => 3, 'name' => 'Waste Dumper']);
        CategorySkill::create(['category_id' => 3, 'name' => 'Renting']);
    }
}
