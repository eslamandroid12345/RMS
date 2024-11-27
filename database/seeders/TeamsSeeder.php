<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            'name_ar' => "البيزنس",
            'name_en' => "Business",
        ]);

        DB::table('teams')->insert([
            'name_ar' => "اليو اي",
            'name_en' => "UI/UX",
        ]);

        DB::table('teams')->insert([
            'name_ar' => "المبيعات",
            'name_en' => "Sales",
        ]);

        DB::table('teams')->insert([
            'name_ar' => "البرمجة",
            'name_en' => "Development",
        ]);
    }
}
