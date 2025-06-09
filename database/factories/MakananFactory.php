<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use FakerRestaurant\Provider\id_ID\Restaurant;
use Bluemmb\Faker\PicsumPhotosProvider;
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

        $this->faker->addProvider(new Restaurant($this->faker));


        return [
            'nama' => $this->faker->foodName(),
            'deskripsi' => $this->faker->sentence(10),
            'harga' => $this->faker->randomFloat(2, 1000, 100000),
            'kategoris_id' => Kategori::where('nama', 'Makanan')->first()?->id ?? Kategori::factory()->create(['nama' => 'Makanan'])->id,
            'mitra_id' => Mitra::inRandomOrder()->first()?->id ?? Mitra::factory(),

        ];
    }
    public function minuman(): static
    {

        return $this->state(function (array $attributes) {
            return [
                'nama' => $this->faker->beverageName(),
                'kategoris_id' => Kategori::where('nama', 'Minuman')->first()?->id ?? Kategori::factory()->create(['nama' => 'Minuman'])->id,
            ];
        });
    }
    public function cemilan(): static
    {

        return $this->state(function (array $attributes) {
            return [
                'nama' => $this->faker->dairyName(),
                'kategoris_id' => Kategori::where('nama', 'Cemilan')->first()?->id ?? Kategori::factory()->create(['nama' => 'Cemilan'])->id,
            ];
        });
    }
    public function sayur(): static
    {

        return $this->state(function (array $attributes) {
            return [
                'nama' => $this->faker->vegetableName(),
                'kategoris_id' => Kategori::where('nama', 'Sayur')->first()?->id ?? Kategori::factory()->create(['nama' => 'Sayur'])->id,
            ];
        });
    }
    public function buah(): static
    {

        return $this->state(function (array $attributes) {
            return [
                'nama' => $this->faker->fruitName(),
                'kategoris_id' => Kategori::where('nama', 'Buah')->first()?->id ?? Kategori::factory()->create(['nama' => 'Buah'])->id,
            ];
        });
    }
    public function daging(): static
    {

        return $this->state(function (array $attributes) {
            return [
                'nama' => $this->faker->meatName(),
                'kategoris_id' => Kategori::where('nama', 'Makanan')->first()?->id ?? Kategori::factory()->create(['nama' => 'Makanan'])->id,
            ];
        });
    }
}
