<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\AqQuestion;
use App\Models\Lecturer;
use App\Models\Student;
use Database\Factories\StudentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Student::factory(100)->create();
        Lecturer::factory(100)->create();
        Alumni::factory(100)->create();

        $this->call([
            SqCategorySeeder::class,
            SqQuestionSeeder::class,
            LqCategorySeeder::class,
            LqQuestionSeeder::class,
            AqCategorySeeder::class,
            AqQuestionSeeeder::class,
            SqAnswerTableSeeder::class
        ]);
    }
}
