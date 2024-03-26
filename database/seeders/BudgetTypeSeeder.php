<?php

namespace Database\Seeders;

use App\Models\BudgetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BudgetType::create(['name'=>'Hour']);
        BudgetType::create(['name'=>'Project']);
        BudgetType::create(['name'=>'Day']);
    }
}
