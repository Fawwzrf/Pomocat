@extends('layouts.admin')
@section('title', 'Edit Tugas')
@section('page-title', 'Edit Tugas')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-6">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Pemilik Tugas</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="sessions_needed" class="block text-sm font-medium text-gray-700">Estimasi Sesi</label>
                    <input type="number" name="sessions_needed" id="sessions_needed" value="{{ old('sessions_needed', $task->sessions_needed) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label for="sessions_completed" class="block text-sm font-medium text-gray-700">Sesi Selesai</label>
                    <input type="number" name="sessions_completed" id="sessions_completed" value="{{ old('sessions_completed', $task->sessions_completed) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $task->notes) }}</textarea>
            </div>
            <div class="flex items-start">
                <div class="flex h-5 items-center"><input id="completed" name="completed" type="checkbox" value="1" {{ old('completed', $task->completed) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600"></div>
                <div class="ml-3 text-sm"><label for="completed" class="font-medium text-gray-700">Tandai sebagai Selesai?</label></div>
                <input type="hidden" name="completed" value="0">
            </div>
        </div>
        <div class="pt-5 mt-5 border-t border-gray-200"><div class="flex justify-end gap-x-3"><a href="{{ route('admin.tasks.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm border">Batal</a><button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Simpan Perubahan</button></div></div>
    </form>
</div>
@endsection