<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mitra>
 */
class MitraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisTempat = $this->faker->randomElement(['Warung makan', 'burjo', 'Cafe', 'Resto']);

        if (in_array($jenisTempat, ['Warung', 'burjo'])) {
            $namaRandom = $this->faker->lastName();
        } else {
            $namaRandom = ucfirst($this->faker->word());
        }

        $nama = $jenisTempat . ' ' . $namaRandom;
        return [
            'name' => $nama,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // atau gunakan Hash::make()
            'deskripsi' => $this->faker->sentence(),
            'alamat' => $this->faker->address(),
            'no_telp' => $this->faker->phoneNumber(),
            'kota' => 'Semarang', // nilai tetap
            'latitude' => $this->faker->latitude(-7.05, -6.95), // area sekitar Semarang
            'longitude' => $this->faker->longitude(110.35, 110.45), // area sekitar Semarang
        ];
    }
}
