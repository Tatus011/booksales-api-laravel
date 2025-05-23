<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'author_id' => 'required|exists:authors,id',
        ]);

        $books = Book::create($validated);
        return response()->json($books, 201);
    }

    public function show($id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($books);
    }

    public function update(Request $request, $id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'price' => 'sometimes|integer',
            'stock' => 'sometimes|integer',
            'author_id' => 'sometimes|exists:authors,id',
        ]);

        $books->update($validated);
        return response()->json($books);
    }

    public function destroy($id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $books->delete();
        return response()->json(['message' => 'Book deleted']);
    }
}
