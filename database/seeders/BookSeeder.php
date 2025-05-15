<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Pulang',
            'description' => 'Kisah perjalanan seorang anak.',
            'price' => 40000,
            'stock' => 10,
            'cover_photo' => 'pulang.jpg',
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
            'description' => 'Filosofi hidup sederhana.',
            'price' => 25000,
            'stock' => 5,
            'cover_photo' => 'seni_bodo_amat.jpg',
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'Naruto Vol. 1',
            'description' => 'Cerita ninja muda.',
            'price' => 30000,
            'stock' => 20,
            'cover_photo' => 'naruto.jpg',
            'author_id' => 3
        ]);

        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif anak-anak Belitung.',
            'price' => 50000,
            'stock' => 10,
            'cover_photo' => 'laskar_pelangi.jpg',
            'author_id' => 4
        ]);

        Book::create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'description' => 'Petualangan penyihir muda.',
            'price' => 60000,
            'stock' => 8,
            'cover_photo' => 'harry_potter.jpg',
            'author_id' => 5
        ]);
    }
}
