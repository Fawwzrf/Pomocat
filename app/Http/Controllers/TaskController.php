<?php // File: app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function render()
    {
        $tasks = Auth::user()->tasks()->orderBy('completed', 'asc')->latest()->get();
        // Kita tidak perlu lagi mengirim activeTaskId dari sini
        return view('pomotime.partials._task-list', compact('tasks'));
    }

    public function index()
    {
        return response()->json(Auth::user()->tasks()->orderBy('completed', 'asc')->latest()->get());
    }
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($task);
    }
    public function store(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string|max:255', 'notes' => 'nullable|string', 'sessions_needed' => 'required|integer|min:1']);
        $task = $request->user()->tasks()->create($validated);
        return response()->json($task, 201);
    }
    public function update(Request $request, Task $task)
    {
        if ($request->user()->id !== $task->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['title' => 'sometimes|required|string|max:255', 'notes' => 'nullable|string', 'sessions_needed' => 'sometimes|required|integer|min:1', 'completed' => 'sometimes|required|boolean']);
        $task->update($validated);
        return response()->json($task);
    }
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $task->delete();
        return response()->json(null, 204);
    }
    public function completeSession(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $task->sessions_completed++;
        if ($task->sessions_completed >= $task->sessions_needed) {
            $task->completed = true;
        }
        $task->save();
        return response()->json($task);
    }
    public function clearCompleted()
    {
        Auth::user()->tasks()->where('completed', true)->delete();
        return response()->json(['message' => 'Tugas yang sudah selesai telah dihapus.']);
    }
    public function clearAll()
    {
        Auth::user()->tasks()->delete();
        return response()->json(['message' => 'Semua tugas telah dihapus.']);
    }
}
