<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Version_morceau;

class VersionMorceauFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VersionMorceau::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'duree_secondes' => $this->faker->word,
            'filepath' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'extension' => $this->faker->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
