@extends('layouts.app')

@section('title', 'PomoTime - Focus Timer')

@section('content')
    {{-- Container utama dengan atribut data yang benar --}}
    <div id="pomotime-container" 
         class="min-h-screen flex justify-center items-start m-0" 
         data-is-guest="{{ $isGuest ? 'true' : 'false' }}"
         data-settings="{{ json_encode($settings) }}">

        <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-7xl flex flex-col lg:flex-row lg:gap-x-20 px-4">
            <div class="w-full lg:w-[500px] shrink-0">
                @include('pomotime.partials._timer')
                @include('pomotime.partials._tasks')
            </div>

            {{-- Kolom Kanan untuk Tombol Report --}}
            <div class="hidden lg:block lg:flex-grow pt-8">
                
                {{-- ======================================================= --}}
                {{-- == BAGIAN PENTING: TOMBOL REPORT KONDISIONAL == --}}
                {{-- ======================================================= --}}

                {{-- TOMBOL INI HANYA TAMPIL JIKA USER LOGIN --}}
                {{-- Tombol ini memiliki atribut data-* untuk membuka modal --}}
                @auth
                    <button data-modal-target="report-modal" data-modal-toggle="report-modal" type="button" class="flex items-center gap-x-2 text-yellow-100 bg-indigo-900 hover:bg-indigo-950 font-bold rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                        Report
                    </button>
                @endauth
                
                {{-- TOMBOL INI HANYA TAMPIL JIKA PENGGUNA ADALAH TAMU --}}
                {{-- Tombol ini TIDAK memiliki atribut data-* --}}
                @guest
                    <button id="report-btn-guest" type="button" class="flex items-center gap-x-2 text-yellow-100/50 bg-indigo-900/50 cursor-not-allowed font-bold rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        Report
                    </button>
                @endguest
            </div>
        </div>
    </div>
    
    {{-- MODAL LAPORAN HANYA DI-RENDER KE HTML JIKA PENGGUNA LOGIN --}}
    @auth
        @include('pomotime.partials._modal-report')
    @endauth
    
    @include('pomotime.partials._modal-add-task')
    @include('pomotime.partials._modal-settings')
    <audio id="alarm-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
@endsection