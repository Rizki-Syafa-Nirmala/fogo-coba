<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Makanan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('iniadmin'),
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'no_telp' => '085889251312',
            'password' => Hash::make('iniuser'),
            'is_admin' => false,
            'point' => '1000'

        ]);

       DB::table('mitras')->insert([
            [
                'name' => 'Nasi Goreng Bang ansor',
                'email' => 'mitra1@example.com',
                'no_telp' => '085889251312',
                'alamat' => 'Jl. Mr. Koesbiyono Tjondrowibowo No.18 A, Patemon, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50228',
                'kota' => 'Kota Semarang',
                'latitude' => '-7.0670972',
                'longitude' => '110.397318',
                'password' => Hash::make('inimitra1')
            ],

            [
                'name' => 'Mitra2',
                'email' => 'mitra2@example.com',
                'no_telp' => '081234567890',
                'alamat' => 'Jl papanggo 1c',
                'kota' => 'Jakarta Utara',
                'latitude' => null,
                'longitude' => null,
                'password' => Hash::make('inimitra2')
            ],

        ]);

        DB::table('kategoris')->insert([
            [
                'nama' => 'Makanan',

            ],
            [
                'nama' => 'Minuman',

            ],
            // [
            //     'nama' => 'Cemilan',

            // ],

            // [
            //     'nama' => 'Sayur',

            // ],


            // [
            //     'nama' => 'Buah',

            // ],

        ]);

        Mitra::factory()->count(20)->create();
        Makanan::factory(40)->create();
        Makanan::factory(50)->minuman()->create();
        // Makanan::factory(10)->cemilan()->create();
        // Makanan::factory(10)->buah()->create();
        // Makanan::factory(10)->sayur()->create();
        Makanan::factory(10)->daging()->create();
    }

}
