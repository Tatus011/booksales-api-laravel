<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        $data = new author(); 
        $authors = $data->getAuthors(); 

        return view('authors', ['authors' => $authors]);
    }
}
