@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.ranking') }}">Ranking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <h2 class="mb-4">Create Ranking</h2>

    <form action="{{ route('admin.ranking.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter full name" required>
        </div>

        <div class="mb-3">
            <label for="rank" class="form-label">Rank</label>
            <input type="number" id="rank" name="rank" class="form-control" placeholder="Enter rank" required>
        </div>

        <div class="mb-3">
            <label for="hours" class="form-label">Hours</label>
            <input type="number" id="hours" name="hours" class="form-control" placeholder="Enter the time" required>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.ranking') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
@endsection
