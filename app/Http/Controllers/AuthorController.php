<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() 
    {
        $authors = Author::all();

         return response()->json($authors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'bio' => 'nullable|string',
        ]);

        $author = Author::create($request->all());

        return response()->json([
            'message' => 'Author berhasil dibuat',
            'data' => $author
        ], 201);
    }
}
