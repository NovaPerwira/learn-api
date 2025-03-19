<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      // Get all todos
      public function index()
      {
          return response()->json(Todo::all(), 200);
      }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $todo = Todo::create($validated);
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
     // Show a single todo
     public function show(Todo $todo)
     {
         return response()->json($todo, 200);
     }

    /**
     * Update the specified resource in storage.
     */
    // Update a todo
    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $todo->update($validated);
        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
     // Delete a todo
     public function destroy(Todo $todo)
     {
         $todo->delete();
         return response()->json(['message' => 'Todo deleted'], 200);
     }
}
