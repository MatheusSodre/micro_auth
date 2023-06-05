<?php

namespace Database\Factories\Permission;


use Illuminate\Database\Eloquent\Factories\Factory;


class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
        ];
    }
}
