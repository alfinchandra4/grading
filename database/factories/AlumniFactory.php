<?php

namespace Database\Factories;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumniFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alumni::class;

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
            'nim'  => $this->faker->numberBetween(10, 16).$rdm.'12'.$this->faker->numberBetween(001, 999),
            'password' => bcrypt('password'),
            'faculty' => 'Ilmu Komputer',
            'major' => $this->faker->numberBetween(1, 3),
            // 1 - SI
            // 2 - TI
            // 3 - MI
            'generation' => $this->faker->numberBetween(2010, 2016),
            'gender' => $this->faker->numberBetween(1, 2),
            'birth' => $this->faker->address,
            'dob' => $this->faker->date('Y-m-d', 'now'),
            'phone' => $this->faker->e164PhoneNumber ,
            'email' => $this->faker->email,
        ];
    }
}
