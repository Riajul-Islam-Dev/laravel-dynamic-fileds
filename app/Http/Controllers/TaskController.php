<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tasks.*' => 'required|string|max:255',
        ]);

        try {
            foreach ($request->tasks as $task) {
                Task::create(['name' => $task]);
            }

            return response()->json(['message' => 'Tasks created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating tasks'], 500);
        }
    }
}
