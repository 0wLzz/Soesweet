<?php

namespace Database\Factories;

use App\Models\InvoiceHeader;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'invoice_header_id' => InvoiceHeader::factory(),
            'product_id' => $this->faker->numberBetween(1, 15),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}

