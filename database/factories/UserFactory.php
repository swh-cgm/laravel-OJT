<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'=>$this->faker->email,
            'password'=>Hash::make("testpassword123"),
            'name'=>$this->faker->lastName,
            'img'=>'default-pfp.png',
            'role'=>2,
            'created_by'=>1, //change later
            'updated_by'=>1
        ];
    }
}
