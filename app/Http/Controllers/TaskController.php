<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Menampilkan semua task milik user yang sedang login.
     * Digunakan untuk mengisi daftar task saat halaman dimuat.
     */
    public function index()
    {
        // Mengambil semua task milik user yang terotentikasi
        // Diurutkan berdasarkan status 'completed' lalu tanggal dibuat
        $tasks = Auth::user()->tasks()->orderBy('completed', 'asc')->latest()->get();

        return response()->json($tasks);
    }

    /**
     * Menyimpan task baru ke database.
     * Dipanggil saat user mengirim form 'Add Task'.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'sessions_needed' => 'required|integer|min:1',
        ]);

        // Membuat task baru yang langsung terhubung dengan user yang sedang login
        $task = $request->user()->tasks()->create([
            'title' => $validated['title'],
            'notes' => $validated['notes'],
            'sessions_needed' => $validated['sessions_needed'],
            // Field lain akan menggunakan nilai default dari migrasi
        ]);

        return response()->json($task, 201); // 201 = Created
    }

    /**
     * Memperbarui task yang sudah ada.
     * Digunakan untuk:
     * - Menandai task selesai (checklist)
     * - Menambah jumlah sesi selesai
     * - (Nantinya) Mengedit detail task
     */
    public function update(Request $request, Task $task)
    {
        // Otorisasi: Pastikan user yang request adalah pemilik task
        if ($request->user()->id !== $task->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403); // 403 = Forbidden
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'notes' => 'nullable|string',
            'sessions_needed' => 'sometimes|required|integer|min:1',
            'sessions_completed' => 'sometimes|required|integer|min:0',
            'completed' => 'sometimes|required|boolean',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    /**
     * Menghapus task.
     * Dipanggil saat user menekan tombol hapus pada sebuah task.
     */
    public function destroy(Request $request, Task $task)
    {
        // Otorisasi: Pastikan user yang request adalah pemilik task
        if ($request->user()->id !== $task->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(null, 204); // 204 = No Content (sukses tanpa body balasan)
    }

    public function completeSession(Request $request, Task $task)
    {
        // Otorisasi: Pastikan user yang request adalah pemilik task
        if ($request->user()->id !== $task->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Tambah jumlah sesi yang selesai
        $task->sessions_completed++;

        // Jika sesi selesai sudah memenuhi yang dibutuhkan, tandai task sebagai completed
        if ($task->sessions_completed >= $task->sessions_needed) {
            $task->completed = true;
        }

        $task->save();

        return response()->json($task);
    }
}
