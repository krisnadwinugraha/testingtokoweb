<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'foto' => 'testimonial1.jpg',
            'nama' => 'Budi',
            'deskripsi' => 'Budi Menyukai Produk Ini',
        ]);

        Testimonial::create([
            'foto' => 'testimonial2.jpg',
            'nama' => 'Bima',
            'deskripsi' => 'Bima Menyukai Produk Ini',
        ]);

        Testimonial::create([
            'foto' => 'testimonial3.jpg',
            'nama' => 'Udin',
            'deskripsi' => 'Udin Menyukai Produk Ini',
        ]);
    }
}
