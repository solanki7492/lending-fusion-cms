<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-wrapper {
            flex: 1;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px 0;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
        }
        .sidebar a {
            padding: 10px 20px;
            display: block;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .content {
            flex: 1;
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">My App</a>
    </nav>

    <!-- Main Section -->
    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            @if(Auth::check())
                <a href="{{ route('termsheet') }}">Termsheet</a>
                <a href="#">
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </a>
            </form>
        @endif
        </aside>

        <!-- Main Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
