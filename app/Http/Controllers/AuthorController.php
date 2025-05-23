<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $authors = Author::create($validated);
        return response()->json($authors, 201);
    }

    public function show($id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($authors, 200);
    }

    public function update(Request $request, $id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $authors->update($validated);
        return response()->json($authors, 200);
    }

    public function destroy($id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $authors->delete();
        return response()->json(['message' => 'Author deleted'], 200);
    }
}
