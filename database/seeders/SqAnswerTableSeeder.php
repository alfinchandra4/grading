<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i=0; $i < 60; $i++) { 
            if ($i < 20) {
                $student_id = 1;
            } elseif ($i > 21 && $i < 40 ) {
                $student_id = 2;
            } elseif ($i > 40 && $i < 60) {
                $student_id = 3;
            }
            DB::table('sq_answers')->insert([
                'answer' => $faker->numberBetween(1, 4),
                'student_id' => $student_id,
                'sq_category_id' => 1,
                'sq_question_id' => 1,
            ]);
        }
    }
}
