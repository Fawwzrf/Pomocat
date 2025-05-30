@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Dashboard</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Users Active</h5>
                    <h3>{{ $usersActive }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5>Active Tasks</h5>
                    <h3>{{ $activeTasks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Productivity</h5>
                    <h3>{{ $productivity }}%</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tasks Performance --}}
    <div class="card mb-4">
        <div class="card-header">Tasks Performance</div>
        <div class="card-body">
            <ul>
                <li>Completed: {{ $taskData['completed'] }}%</li>
                <li>In Progress: {{ $taskData['inProgress'] }}%</li>
                <li>Behind: {{ $taskData['behind'] }}%</li>
            </ul>
        </div>
    </div>

    {{-- Top Users --}}
    <div class="card mb-4">
        <div class="card-header">Top User</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th><th>User Name</th><th>Total Time</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topUsers as $i => $user)
                        <tr>
                            <td>#{{ $i+1 }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['time'] }}</td>
                            <td>
                                <span class="badge {{ $user['status'] == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $user['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
