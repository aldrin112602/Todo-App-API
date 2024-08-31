<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
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
            return $this->handleException($e, 'Failed to fetch tasks');
        }
    }

    // Create new task
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
            ]);

            $task = Task::create($request->all());
            return response()->json($task, 201);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to create task');
        }
    }

    // Get specific task by `id`
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json($task);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch task');
        }
    }

    // Update specific task by `id`
    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $request->validate([
                'title' => 'required|string|max:255',
            ]);

            $task->update($request->all());
            return response()->json($task);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to update task');
        }
    }

    // Remove specific task by `id`
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully']);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to delete task');
        }
    }

}
