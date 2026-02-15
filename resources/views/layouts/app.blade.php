<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Managment</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-kanban-fill me-2"></i>TaskFlow
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('tasks.index')}}"><i class="bi bi-list-check me-1"></i>Vazifalar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.index')}}"><i class="bi bi-people me-1"></i>Foydalanuvchilar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('task-history.index')}}"><i class="bi bi-clock-history me-1"></i>Vazifa tarixi</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">

                <div>
                    Admin
                    <button class="btn bg-purple rounded-circle text-center text-white " type="button">
                        A
                    </button>
                </div>

                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary-subtle">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Chiqish
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-3">
    @yield('content')
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
