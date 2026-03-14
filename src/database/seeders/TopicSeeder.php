<?php

namespace Database\Seeders;

use App\Models\Domains;
use App\Models\Topics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            ['Number Expressions', 'Algebra'],
            ['Data','Statistics and Probability'],
            ['Coordinates','Geometry'],
            ['Triangles','Geometry'],
            ['Circles','Geometry'],
            ['Variables','Algebra'],
            ['Equations and Graphs','Algebra'],
        ];

        foreach ($topics as $topic) {
            [$name, $domainName] = $topic;

            $domainId = Domains::where('name', $domainName)->value('id');

            Topics::create([
                'name'=> $name,
                'domain_id' => $domainId,
            ]);
        }
    }
}
