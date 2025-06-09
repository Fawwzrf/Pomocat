@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna: ' . $user->name)

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="space-y-6">
            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            {{-- Role Admin --}}
            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input id="is_admin" name="is_admin" type="checkbox" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_admin" class="font-medium text-gray-700">Jadikan sebagai Admin?</label>
                    <p class="text-gray-500">Pengguna dengan role admin akan memiliki akses ke dashboard ini.</p>
                </div>
            </div>
            
            {{-- Hidden input untuk is_admin jika checkbox tidak dicentang --}}
            <input type="hidden" name="is_admin" value="0">
        </div>

        <div class="pt-5 mt-5 border-t border-gray-200">
            <div class="flex justify-end gap-x-3">
                <a href="{{ route('admin.users.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50">Batal</a>
                <button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection