<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan daftar semua tugas
    public function index(Request $request)
    {
        $search = $request->query('search');

        $tasks = Task::query()
            ->with('user')
            ->withTrashed()
            ->when($search, function ($query, $searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$searchTerm}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.tasks.index', compact('tasks'));
    }

    // Menampilkan form untuk membuat tugas baru
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.tasks.create', compact('users'));
    }

    // Menyimpan tugas baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'sessions_needed' => ['required', 'integer', 'min:1'],
        ]);

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas baru berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit tugas
    public function edit(Task $task)
    {
        $users = User::orderBy('name')->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    // Memproses pembaruan data tugas
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'sessions_needed' => ['required', 'integer', 'min:1'],
            'sessions_completed' => ['required', 'integer', 'min:0'],
            'completed' => ['required', 'boolean'],
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    // Menghapus tugas (soft delete)
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }
}
