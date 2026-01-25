<?php

namespace Database\Factories;

use App\Models\Wedding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wedding>
 */
class WeddingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wedding::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bride_name' => fake()->firstName('female'),
            'groom_name' => fake()->firstName('male'),
            'package_tier' => fake()->randomElement(['standard', 'premium']),
            'wish_present_enabled' => false,
            'digital_ang_pow_enabled' => false,
            'setup_progress' => 0,
        ];
    }
}
