<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mitra;
use App\Models\Makanan;
use App\Models\Kategori;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Makanan>
 */
class MakananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->words(2, true),
            'deskripsi' => $this->faker->sentence(10),
            'harga' => $this->faker->randomFloat(2, 1000, 100000),
            'kategoris_id' => Kategori::inRandomOrder()->first()?->id ?? Kategori::factory(),
            'mitra_id' => Mitra::inRandomOrder()->first()?->id ?? Mitra::factory(),
        ];
    }
}
