<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1, 
            'name' => 'Fiksi'
        ],
        [
            'id' => 2, 
            'name' => 'Non-Fiksi'
        ],
        [
            'id' => 3, 
            'name' => 'Komik'
        ],
        [
            'id' => 4, 
            'name' => 'Sejarah'
        ],
        [
            'id' => 5, 
            'name' => 'Psikologi'
        ],
    ];

    public function getGenres() {
        return $this->genres;
    }
}
