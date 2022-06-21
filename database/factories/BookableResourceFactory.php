<?php

namespace Database\Factories;

use App\Models\BookableResource;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookableResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookableResource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'quantity' => 1,
        ];
    }
}
