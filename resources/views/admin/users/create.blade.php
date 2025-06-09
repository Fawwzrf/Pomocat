@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')
@section('page-title', 'Tambah Pengguna Baru')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required autofocus>
                @error('name')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('password')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>

            {{-- Role Admin --}}
            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input id="is_admin" name="is_admin" type="checkbox" value="1" {{ old('is_admin') ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_admin" class="font-medium text-gray-700">Jadikan sebagai Admin?</label>
                    <p class="text-gray-500">Pengguna dengan role admin akan memiliki akses ke dashboard ini.</p>
                </div>
            </div>
             <input type="hidden" name="is_admin" value="0">
        </div>

        <div class="pt-5 mt-5 border-t border-gray-200">
            <div class="flex justify-end gap-x-3">
                <a href="{{ route('admin.users.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50">Batal</a>
                <button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Simpan Pengguna</button>
            </div>
        </div>
    </form>
</div>
@endsection