<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FlexibleTime;

class FlexibleTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlexibleTime::create(['name' => 'Morning', 'time' => 'Before 10am', 'icon' => 'morning-icon.png']);
        FlexibleTime::create(['name' => 'Midday', 'time' => '10am - 2pm', 'icon' => 'midday-icon.png']);
        FlexibleTime::create(['name' => 'Afternoon', 'time' => '2pm - 6pm', 'icon' => 'afternoon-icon.png']);
        FlexibleTime::create(['name' => 'Evening', 'time' => 'After 6pm', 'icon' => 'evening-icon.png']);
    }
}
