<?php

namespace Database\Seeders;

use App\Models\UserSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSkill::create([
            'user_id' => 1,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 2,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 3,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 4,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 5,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 6,
            'skill_id' => 1,
            'category_id' => 1
        ]);
        UserSkill::create([
            'user_id' => 7,
            'skill_id' => 1,
            'category_id' => 1
        ]);
    }
}
