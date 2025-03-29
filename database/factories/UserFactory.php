<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'country_code' => '+'.rand(100, 999),
            'start_weight' => rand(10,99),
            'start_weight_unit' => fake()->randomElement(['Kg', 'Lb']),
            'start_height' => rand(100,999),
            'start_height_unit' => fake()->randomElement(['Cm', 'Ft']),
            'goal_id' => fake()->randomElement([1,2,3,4,5]),
            'user_level_id' => fake()->randomElement([1,2,3,4,5]),
            'date_of_birth' => now()->subYears(18),
            'is_admin' => fake()->randomElement([1, 0]),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
