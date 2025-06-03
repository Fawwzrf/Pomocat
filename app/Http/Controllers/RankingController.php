<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RankingController extends Controller
{
    public function index()
    {
        // Ambil data dari session (jika sebelumnya pernah disimpan)
        $sessionData = Session::get('ranking_data');

        // Jika tidak ada data dari session, gunakan data default
        $rankingData = $sessionData ?? [
            ['name' => 'Irfan Romadhon', 'rank' => 1, 'hours' => 180, 'date' => '12/2/2025'],
            ['name' => 'M. Zaki Dzulfikar', 'rank' => 2, 'hours' => 120, 'date' => '12/2/2025'],
            ['name' => 'Revalina Fidya A.', 'rank' => 3, 'hours' => 90, 'date' => '12/2/2025'],
            ['name' => 'Reno Barak', 'rank' => 4, 'hours' => 80, 'date' => '12/2/2025'],
            ['name' => 'Jefri Nichol', 'rank' => 5, 'hours' => 75, 'date' => '12/2/2025'],
            ['name' => 'Prince Chen', 'rank' => 6, 'hours' => 68, 'date' => '12/2/2025'],
            ['name' => 'Devina Karamoy', 'rank' => 7, 'hours' => 55, 'date' => '12/2/2025'],
            ['name' => 'Anselma Putri', 'rank' => 8, 'hours' => 52, 'date' => '13/2/2025'],
            ['name' => 'Melvin Boyle', 'rank' => 9, 'hours' => 51, 'date' => '13/2/2025'],
            ['name' => 'Kailee Thomas', 'rank' => 10, 'hours' => 45, 'date' => '13/2/2025'],
        ];

        // Urutkan ulang berdasarkan rank
        usort($rankingData, fn($a, $b) => $a['rank'] <=> $b['rank']);

        return view('admin.ranking', [
            'rankings' => $rankingData,
            'top3' => array_slice($rankingData, 0, 3)
        ]);
    }

    public function create()
    {
        return view('admin.ranking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'rank' => 'required|integer',
            'hours' => 'required|integer',
        ]);

        $newData = [
            'name' => $request->full_name,
            'rank' => $request->rank,
            'hours' => $request->hours,
            'date' => now()->format('d/m/Y'),
        ];

        // Ambil data lama dari session
        $existingData = Session::get('ranking_data', []);
        $existingData[] = $newData;

        // Simpan kembali ke session
        Session::put('ranking_data', $existingData);

        return redirect()->route('admin.ranking')->with('success', 'Ranking berhasil ditambahkan!');
    }
}
