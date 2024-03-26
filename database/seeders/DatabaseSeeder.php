<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UserSkillSeeder::class,
            CategorySeeder::class,
            FlexibleTimeSeeder::class,
            BudgetTypeSeeder::class,
            CategorySkillSeeder::class,
            FaqSeeder::class,
            MakeOfferSeeder::class,
            PostImageSeeder::class,
            PostSeeder::class,
            PostSkillSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
