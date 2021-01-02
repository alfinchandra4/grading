<?php

namespace Database\Factories;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecturer::class;

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
            'nidn'  => str_replace(',', '', $this->faker->numberBetween(100000000, 999999999)),
            'password' => bcrypt('password'),
            'faculty' => 'Ilmu Komputer',
            'gender' => $this->faker->numberBetween(1, 2),
            'birth' => $this->faker->address,
            'dob' => $this->faker->date('Y-m-d', 'now'),
            'phone' => $this->faker->e164PhoneNumber ,
            'email' => $this->faker->email,
        ];
    }
}
