<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'price', 'stock', 'cover_photo', 'author_id'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
