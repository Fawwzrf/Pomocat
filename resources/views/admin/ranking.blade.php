@extends('layouts.admin')

@section('content')
<h4 class="mb-4">Ranking</h4>

<div class="d-flex justify-content-between mb-3">
    <h5>Dashboard / Ranking</h5>
    <a href="{{ route('admin.ranking.create') }}" class="btn btn-primary">+ NEW RANK</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Rank</th>
            <th>Hours</th>
            <th>Date Rank</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rankings as $i => $rank)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $rank['name'] }}</td>
            <td>{{ $rank['rank'] }}</td>
            <td>{{ $rank['hours'] }}</td>
            <td>{{ $rank['date'] }}</td>
            <td>
                <button class="btn btn-sm btn-primary">↗</button>
                <button class="btn btn-sm btn-secondary">✏️</button>
                <button class="btn btn-sm btn-danger">🗑️</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pemenang Top 3 --}}
<div class="row mt-5">
    @foreach ($top3 as $index => $top)
    <div class="col-md-4 text-center">
        <div class="card p-3 bg-dark text-white">
            <img src="https://via.placeholder.com/80" class="rounded-circle mx-auto mb-2" alt="avatar">
            <h5>{{ $top['name'] }}</h5>
            <div class="mt-2">
                @if ($index == 0)
                    🏆
                @elseif ($index == 1)
                    🥈
                @else
                    🥉
                @endif
            </div>
            <h4>{{ $top['hours'] }} Hours</h4>
        </div>
    </div>
    @endforeach
</div>
@endsection
