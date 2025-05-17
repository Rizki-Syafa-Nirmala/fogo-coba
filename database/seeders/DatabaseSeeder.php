<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Makanan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'password' => Hash::make('iniuser'),
            'is_admin' => false

        ]);

        DB::table('mitras')->insert([
            [
                'name' => 'Mitra1',
                'email' => 'mitra1@example.com',
                'password' => Hash::make('inimitra1')
            ],
            
            [
                'name' => 'Mitra2',
                'email' => 'mitra2@example.com',
                'password' => Hash::make('inimitra2')
            ],

        ]);

        DB::table('kategoris')->insert([
            [
                'nama' => 'Makanan Berat',
                
            ],
            
            [
                'nama' => 'Makanan Ringan',
                
            ],
        ]);

        Makanan::factory(20)->create();
    }

}
