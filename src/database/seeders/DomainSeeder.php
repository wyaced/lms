<?php

namespace Database\Seeders;

use App\Models\Domains;
use App\Models\GradeLvls;
use App\Models\Subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function attachGradeLvls($domain, $gradeLvls)
    {
        foreach ($gradeLvls as $gradeLvl) {
            $gradeLvlId = GradeLvls::where('grade_lvl', $gradeLvl)->value('id');

            $domain->gradeLvls()->attach($gradeLvlId);
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            ['Algebra', 'Mathematics', [7, 8]],
            ['Statistics and Probability','Mathematics', [7, 9]],
            ['Geometry', 'Mathematics', [7, 8, 9, 10]],
        ];

        foreach ($domains as $domain) { 
            [$name, $subjectName, $gradeLvls] = $domain;

            $subjectId = Subjects::where('name', $subjectName)->value('id');

            $domain = Domains::create([
                'name' => $name,
                'subject_id' => $subjectId,
            ]);

            $this->attachGradeLvls($domain, $gradeLvls);
        }
    }
}
