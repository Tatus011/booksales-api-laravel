<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index() 
    {
        $genres = Genre::all(); 

         return response()->json($genres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::create($request->all());

        return response()->json([
            'message' => 'Genre berhasil dibuat',
            'data' => $genre
        ], 201);
    }
}
