<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'bio'];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    
    private $authors = [
        [
            'id' => 1, 
            'name' => 'Tere Liye'
        ],
        [
            'id' => 2, 
            'name' => 'Mark Manson'
        ],
        [
            'id' => 3, 
            'name' => 'Masashi Kishimoto'
        ],
        [
            'id' => 4, 
            'name' => 'Dewi Lestari'
        ],
        [
            'id' => 5, 
            'name' => 'Pramoedya Ananta Toer'
        ],
    ];

    public function getAuthors() {
        return $this->authors;
    }
}
