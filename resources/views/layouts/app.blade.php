<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Managment</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
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
                    <a class="nav-link" href="{{route('users.index')}}"><i class="bi bi-people me-1"></i>Foydalanuvchilar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('task-history.index')}}"><i class="bi bi-clock-history me-1"></i>Vazifa tarixi</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-light btn-sm me-3">
                    <a href="{{ route('logout') }}"
                </button>
                <div class="dropdown">
                    <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown">
                        A
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">admin<br><small class="text-muted">Admin</small></h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Sozlamalar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Chiqish</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    @yield('content')
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
