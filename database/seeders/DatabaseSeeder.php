<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Alumni;
use App\Models\AqQuestion;
use App\Models\Lecturer;
use App\Models\Student;
use Database\Factories\StudentFactory;
use App\Models\Dean;
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
        Dean::factory(1)->create();
        Administrator::factory(1)->create();

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
