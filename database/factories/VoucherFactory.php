<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->lexify('VOUCHER-????'), // Bikin kode unik, misal VOUCHER-ABCD
            'discount_value' => fake()->randomElement([10000, 20000, 50000]), // Bikin nilai diskon acak
            'is_used' => fake()->boolean(50), // Kemungkinan true/terpakai itu 50%
        ];
    }
}
