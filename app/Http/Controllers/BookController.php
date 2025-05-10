<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $data = new book(); // Membuat objek
        $books = $data->getBooks(); // Mengakses method getBooks

        return view('books', ['books' => $books]); // Mengirim data buku ke view
    }
}
