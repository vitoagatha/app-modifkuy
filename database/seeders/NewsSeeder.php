<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class NewsSeeder extends Seeder
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
            $imagePath = 'uploads/news/' . $imageName;

            // Mengunduh gambar dari Faker menggunakan Guzzle dan menyimpannya ke storage
            $response = $client->get($faker->imageUrl(640, 480, 'news', true));
            Storage::disk('public')->put($imagePath, $response->getBody()->getContents());

            News::create([
                'gambar' => $imageName,
                'title' => $faker->sentence(5),
                'link_news' => $faker->url,
            ]);
        }
    }
}
