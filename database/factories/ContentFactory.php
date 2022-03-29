<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contents>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'publicationdate' => $this->faker->date(),
            'content' => $this->faker->sentence(),
            'theme' => $this->faker->word(3),
            'keywords' => $this->faker->word(5),
            'buyerJourney' => $this->faker->randomElement(['ADVOCACY', 'AWARENESS', 'CONSIDERATION']),
            'objeccleartive' => $this->faker->sentence(),
            'cta' => $this->faker->randomElement(['link', 'external link', 'internal link', 'regioster form', 'comments', 'share']),
            'addedto' => $this->faker->name(),
        ];
    }
}
