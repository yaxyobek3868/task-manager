<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Managment</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" @class(['nav-link', 'active' => request()->routeIs('tasks.*')])>
                        Vazifalar
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" @class(['nav-link', 'active' => request()->routeIs('users.*')])>
                        Foydanaluvchilar

                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task-history.index') }}" @class(['nav-link', 'active' => request()->routeIs('vazifa.*')])>
                        Vazifa tarixi
                    </a>
            </ul>

            <ul class="navbar-nav ms-auto mb-2">
                @auth
                    <li class="nav-item">
                        <a href="/">
                            Role
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">
                               Chiqish
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    @yield('content')
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
