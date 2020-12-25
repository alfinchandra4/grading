<?php

namespace Database\Factories;

use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arr = [105, 106, 107];
        $rdm = $arr[array_rand($arr)];
        return [
            'name' => $this->faker->name,
            'nim'  => '17'.$rdm.'12'.$this->faker->numberBetween(001, 999),
            'password' => bcrypt('password'),
            'faculty' => 'Ilmu Komputer',
            'major' => $this->faker->numberBetween(1, 3),
            'generation' => $this->faker->numberBetween(2017, 2020),
            'gender' => $this->faker->numberBetween(1, 2),
            'birth' => $this->faker->address,
            'dob' => $this->faker->date('Y-m-d', 'now'),
            'phone' => $this->faker->e164PhoneNumber ,
            'email' => $this->faker->email,
        ];
    }
}
