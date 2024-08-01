<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(['id', 'title']);
        return response()->json($tasks);
    }

    public function getUserTasks()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->get(['id', 'title']);
        return response()->json($tasks);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:baja,media,alta',
            'completed' => 'required|boolean',
        ]);

        $task->update($request->only(['title', 'priority', 'completed']));

        return response()->json(['message' => 'Tarea actualizada exitosamente.']);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada exitosamente.']);
    }
}
