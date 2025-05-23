<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genres = Genre::create($validated);
        return response()->json($genres, 201);
    }

    public function show($id)
    {
        $genres = Genre::find($id);

        if (!$genres) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        return response()->json($genres, 200);
    }

    public function update(Request $request, $id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genres->update($validated);
        return response()->json($genres, 200);
    }

    public function destroy($id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $genres->delete();
        return response()->json(['message' => 'Genre deleted'], 200);
    }
}
