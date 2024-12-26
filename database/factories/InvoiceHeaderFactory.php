<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceHeader>
 */
class InvoiceHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['Proses', 'Diterima', 'Cancel']);

        if($status !== 'Proses'){
            $admin = $this->faker->numberBetween(1,2);
        }
        else {
            $admin = null;
        }

        return [
            'id' => $this->faker->unique()->numberBetween(1,1000),
            'user_id' => $this->faker->numberBetween(1,10),
            'admin_id' => $admin,
            'total_price' => $this->faker->randomFloat(2, 1000, 1000000),
            'review' => $this->faker->text(100),
            'status' => $status,
            'cancel' => $status === 'Cancel' ? $this->faker->text(20) : null,
            'created_at' => $this->faker->dateTime()->format('Y-m-d H:i:s')
            ];
        }
}
