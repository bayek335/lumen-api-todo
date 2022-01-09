<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            [
                "email" => "ad0286a7-bec4-405c-96e2-cd472c18a1e7@skyshi.com",
                "title" => "coba 1",
            ],
            [
                "email" => "ad0286a7-bec4-405c-96e2-cd472c18a1e8@skyshi.com",
                "title" => "coba 2",
            ],
            [
                "email" => "ad0286a7-bec4-405c-96e2-cd472c18a1e9@skyshi.com",
                "title" => "coba 3",
            ],
            [
                "email" => "ad0286a7-bec4-405c-96e2-cd472c18a1e0@skyshi.com",
                "title" => "coba 4",
            ],
        ]);
    }
}
