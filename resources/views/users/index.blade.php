@extends('layouts.app')
@section('title', 'Foydalanuvchilarni boshqarish')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/users.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-people text-primary me-3" style="font-size: 2.5rem;"></i>
            <div>
                <h1>Foydalanuvchilarni boshqarish</h1>
                <p>Foydalanuvchi rollari, ruxsatlari va hisob holatini boshqaring</p>
            </div>
        </div>
    </div>

    <div class="stats-cards">
        <div class="stat-card primary">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Jami foydalanuvchilar</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>

        <div class="stat-card success">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Faol foydalanuvchilar</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['active'] }}</div>
        </div>

        <div class="stat-card warning">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Tasdiqlani kutmaqda</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stats['pending'] }}</div>
        </div>
    </div>

    <form method="GET" action="{{ route('user.index') }}" oninput="this.form.submit()">
        <div class="search-input">
            <i class="fa-solid  fa-search"></i>
            <input type="text" name="search" class="form-control js_search"
                   placeholder="Foydalanuvchi nomi yoki email bo'yicha qidirish..."
                   value="{{ request('search') }}">
        </div>
    </form>

    <div class="users-table-container">
        <div class="table-responsive">
            <table class="users-table">
                <thead>
                <tr>
                    <th>FOYDALANUVCHI</th>
                    <th>HOLAT</th>
                    <th>ROL</th>
                    <th>RO'YXATDAN O'TGAN</th>
                    <th>AMALLAR</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar color-1">
                                    {{ $user->name }}
                                </div>
                                <div class="user-details">
                                    <h6>{{ $user->name }}</h6>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($user->status->isActive())
                                <span class="badge badge-success">
                                    <i class="fa-solid fa-check"></i>
                                    Active
                                </span>
                            @elseif($user->status->isPending())
                                <span class="badge badge-warning">
                                    <i class="fa-solid fa-history"></i>
                                    Pending
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    InActive
                                </span>
                            @endif
                        </td>

                        <td>
                            <span class="role-badge">
                                <i class="fa-solid fa-check"></i>
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </td>

                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{route('user.change-role', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="action-select" onchange="this.form.submit()">
                                        <option value="0" {{ $user->role->isNoRole() ? 'selected' : '' }}>Roli yoq</option>
                                        <option value="1" {{ $user->role->isAdmin() ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $user->role->isManager() ? 'selected' : '' }}>Menejer</option>
                                        <option value="3" {{ $user->role->isEmployee() ? 'selected' : '' }}>Foydalanuvchi</option>
                                    </select>
                                </form>

                                <form action="{{route('user.change-status', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="action-select" onchange="this.form.submit()">
                                        <option value="1" {{ $user->status->isPending() ? 'selected' : '' }}>Kutilmoqda</option>
                                        <option value="2" {{ $user->status->isActive() ? 'selected' : '' }}>Faol</option>
                                        <option value="3" {{ $user->status->isInActive() ? 'selected' : '' }}>O`chirilgan</option>
                                    </select>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('script')
    <script type="application/javascript">

    </script>
@endpush
