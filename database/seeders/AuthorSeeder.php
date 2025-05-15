<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Tere Liye', 
            'bio' => 'Penulis fiksi terkenal.'
        ]);

        Author::create([
            'name' => 'Mark Manson', 
            'bio' => 'Penulis motivasi.'
        ]);

        Author::create([
            'name' => 'J.K. Rowling', 
            'bio' => 'Penulis Harry Potter.'
        ]);

        Author::create([
            'name' => 'Pramoedya Ananta Toer', 
            'bio' => 'Sastrawan Indonesia.'
        ]);

        Author::create([
            'name' => 'Andrea Hirata', 
            'bio' => 'Penulis Laskar Pelangi.'
        ]);
    }
}
