<?php

namespace Database\Seeders;

use App\Models\Garage;
use App\Models\GarageImage;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GarageImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $client = new Client();

        // Ambil semua entri garage
        $garages = Garage::all();

        // Loop untuk setiap garage
        foreach ($garages as $garage) {
            // Simpan beberapa gambar untuk setiap garage
            for ($i = 1; $i <= 3; $i++) {
                // Generate nama file unik
                $imageName = 'foto_' . uniqid() . '_' . $i . '.jpg';

                // Unduh gambar dari Faker menggunakan Guzzle dan simpan ke storage
                $response = $client->get($faker->imageUrl(640, 480, 'garage', true));
                $imagePath = 'uploads/garage/' . $imageName;
                Storage::disk('public')->put($imagePath, $response->getBody()->getContents());

                // Buat entri baru di tabel garage_images
                GarageImage::create([
                    'garage_id' => $garage->id,
                    'image_path' => $imageName,
                ]);
            }
        }
    }
}
