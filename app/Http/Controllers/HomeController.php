<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Pastikan hanya user yang terotentikasi yang bisa mengakses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman "home" aplikasi.
     */
    public function index()
    {
        // Cukup tampilkan view 'home'
        return view('home');
    }
}
