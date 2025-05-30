<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- jika pakai Vite --}}
</head>
<body>
    <div class="d-flex">
        @include('admin.sidebar')
        <main class="flex-fill p-4 bg-light" style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>
</body>
</html>
