<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() 
    {
        $books = Book::all(); 

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }
}
