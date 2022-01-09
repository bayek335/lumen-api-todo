<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToDosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            [
                'activity_group_id' => random_int(1, 4),
                'title' => 'item1',
                'is_active' => random_int(0, 1),
                'priority' => 'very-hight',
            ],
            [
                'activity_group_id' => random_int(1, 4),
                'title' => 'item2',
                'is_active' => random_int(0, 1),
                'priority' => 'very-hight',
            ],
            [
                'activity_group_id' => random_int(1, 4),
                'title' => 'item3',
                'is_active' => random_int(0, 1),
                'priority' => 'very-hight',
            ],
            [
                'activity_group_id' => random_int(1, 4),
                'title' => 'item4',
                'is_active' => random_int(0, 1),
                'priority' => 'very-hight',
            ],
            [
                'activity_group_id' => random_int(1, 4),
                'title' => 'item5',
                'is_active' => random_int(0, 1),
                'priority' => 'very-hight',
            ],
        ]);
    }
}
