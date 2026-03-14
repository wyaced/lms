<?php

namespace Database\Seeders;

use App\Models\GradeLvls;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeLvlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grade_lvls = [
            7,
            8,
            9,
            10,
        ];

        foreach ($grade_lvls as $grade_lvl) {
            GradeLvls::create([
                'grade_lvl' => $grade_lvl,
            ]);
        }
    }
}
