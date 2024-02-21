<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => "0396820469",
            'password' => Hash::make(12345678),
            'gender' => rand(1, 2),
            'position' => rand(1, 2),
            'school_id' => 1,
            'major_name' => "Công nghệ thông tin",
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
