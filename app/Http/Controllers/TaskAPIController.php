<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{

    // get all task 
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // Create new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isCompleted' => 'required|boolean',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // get specific task by `id`
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    // update specific task by `id`
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'isCompleted' => 'required|boolean',
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    // remove specific task by `id`
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
