@extends('layouts.admin')
@section('title', 'Tambah Tugas Baru')
@section('page-title', 'Tambah Tugas Baru')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Pemilik Tugas</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="" disabled selected>Pilih Pengguna</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="sessions_needed" class="block text-sm font-medium text-gray-700">Estimasi Sesi</label>
                <input type="number" name="sessions_needed" id="sessions_needed" value="{{ old('sessions_needed', 1) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes') }}</textarea>
            </div>
        </div>
        <div class="pt-5 mt-5 border-t border-gray-200"><div class="flex justify-end gap-x-3"><a href="{{ route('admin.tasks.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm border">Batal</a><button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Simpan Tugas</button></div></div>
    </form>
</div>
@endsection