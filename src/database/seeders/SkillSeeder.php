<?php

namespace Database\Seeders;

use App\Models\Skills;
use App\Models\Topics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['GEMDAS', 'Number Expressions'],
            ['Expression From Patterns','Number Expressions'],
            ['Exponents','Number Expressions'],
            ['Decimals','Number Expressions'],
            ['Fractions','Number Expressions'],
            ['Algebraic Representation','Number Expressions'],
            ['Interpreting Graphs','Data'],
            ['Variability','Data'],
            ['Determining Probability','Data'],
            ['Numberlines','Coordinates'],
            ['Cartesian Plane','Coordinates'],
            ['Distance Formula','Coordinates'],
            ['Area of Triangles','Triangles'],
            ['Angles in a Triangle','Triangles'],
            ['Sides in a Triangle','Triangles'],
            ['Area of Circles', 'Circles'],
            ['Circumference of Circles','Circles'],
            ['Volume of Cylinders','Circles'],
            ['Rotation','Circles'],
            ['Algebraic Expressions','Variables'],
            ['Equations with Unknowns','Variables'],
            ['Properties of Equality','Equations and Graphs'],
            ['Linear Equations','Equations and Graphs'],
            ['Formulas','Equations and Graphs'],
            ['Aspects of Graphs','Equations and Graphs'],
        ];

        foreach ($skills as $skill) {
            [$name, $topicName] = $skill;

            $topicId = Topics::where('name', $topicName)->value('id');

            Skills::create([
                'name' => $name,
                'topic_id' => $topicId,
            ]);
        }
    }
}
