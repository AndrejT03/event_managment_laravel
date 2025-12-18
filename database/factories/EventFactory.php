<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->text(140),
            'type' => fake()->randomElement(['seminar', 'workshop', 'lecture']),
            'date' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'organizer_id' => Organizer::factory(),
        ];
    }
}
