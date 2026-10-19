<?php

namespace Database\Seeders;

use App\Models\Garage;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class GarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $client = new Client();

        for ($i = 0; $i < 10; $i++) {
            $imageName = 'foto_' . uniqid() . '.jpg';
            $imagePath = 'uploads/garage/' . $imageName;

            // Mengunduh gambar dari Faker menggunakan Guzzle dan menyimpannya ke storage
            $response = $client->get($faker->imageUrl(640, 480, 'garage', true));
            Storage::disk('public')->put($imagePath, $response->getBody()->getContents());

            Garage::create([
                'gambar' => $imageName,
                'title' => $faker->sentence(3),
                'categories' => $faker->randomElement(['matic', 'manual']),
                'description' => $faker->paragraph,
            ]);
        }
    }
}
