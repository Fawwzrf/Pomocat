<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman panduan.
     */
    public function guide()
    {
        return view('guide');
    }
}
