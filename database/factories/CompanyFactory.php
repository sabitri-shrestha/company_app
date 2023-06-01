<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Define your model's default state here
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'logo' => $this->faker->imageUrl(100, 100),
            'website' => $this->faker->url,
        ];
    }
}
