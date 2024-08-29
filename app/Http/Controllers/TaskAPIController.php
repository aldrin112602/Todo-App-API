<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class TaskAPIController extends Controller
{
    // Get all tasks
    public function index()
    {
        try {
            $tasks = Task::all();
            return response()->json($tasks);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch tasks', 'message' => $e->getMessage()], 500);
        }
    }

    // Create new task
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'isCompleted' => 'required',
            ]);

            $task = Task::create($request->all());
            return response()->json($task, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create task', 'message' => $e->getMessage()], 500);
        }
    }

    // Get specific task by `id`
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch task', 'message' => $e->getMessage()], 500);
        }
    }

    // Update specific task by `id`
    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            Log::info("Task ID: $id");

            $request->validate([
                'title' => 'required|string|max:255',
                'isCompleted' => 'required',
            ]);

            $task->update($request->all());
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update task', 'message' => $e->getMessage()], 500);
        }
    }

    // Remove specific task by `id`
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            Log::info("Task ID: $id");
            
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete task', 'message' => $e->getMessage()], 500);
        }
    }
}
