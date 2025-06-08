@extends('layouts.app') {{-- Asumsikan Anda memiliki layout utama --}}

@section('title', 'PomoTime - Focus Timer')

@section('content')
    {{-- Kontainer utama halaman dengan background gradien --}}
    <div class="min-h-screen flex justify-center items-start m-0">

        {{-- Kontainer untuk PomoTime dan Tasks, mengatur lebar dan posisi --}}
        <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-7xl flex flex-col lg:flex-row lg:gap-x-20 px-4">

            {{-- Kolom Utama untuk PomoTime dan Tasks --}}
            <div class="w-full lg:w-[500px] shrink-0">

                {{-- Bagian Timer --}}
                @include('partials._timer')

                {{-- Bagian Tasks --}}
                @include('partials._tasks')

                
            </div>

            {{-- Kolom Kanan untuk Tombol Report --}}
            <div class="hidden lg:block lg:flex-grow pt-8">
                <button data-modal-target="report-modal" data-modal-toggle="report-modal" type="button"
                    class="flex items-center gap-x-2 text-yellow-100 bg-indigo-900 hover:bg-indigo-950 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    Report
                </button>
            </div>
        </div>
    </div>

    
    @include('partials._modal-add-task')
    @include('partials._modal-settings')
    @include('partials._modal-report')

    {{-- Elemen Audio untuk Notifikasi --}}
    <audio id="alarm-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
@endsection


