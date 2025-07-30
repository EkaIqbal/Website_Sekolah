<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('beritas')->insert([
                'title' => 'Judul Berita ke-' . $i,
                'excerpt' => 'Ini adalah ringkasan dari berita ke-' . $i,
                'content' => Str::random(200),
                'image_url' => 'gambar' . $i . '.jpg',
                'link' => 'https://berita.local/berita-' . $i,
                'created_at' => Carbon::now()->subDays($i),
                'updated_at' => Carbon::now()->subDays($i),
            ]);
        }
    }
}
