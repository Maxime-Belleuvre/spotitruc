<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Artiste;

class ArtisteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artiste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'date_naissance' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'nationalite' => $this->faker->country(),
            'pseudo' => $this->faker->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
