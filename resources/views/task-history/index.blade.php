@extends('layouts.app')
@section('title', 'Vazifa tarixi')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/task-history.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-clock-history text-primary me-3" style="font-size: 2.5rem;"></i>
            <div>
                <h1>Vazifa tarixi</h1>
                <p>Barcha vazifa faoliyatlarining to'liq auditlash jurnali</p>
            </div>
        </div>
</div>
    <div class="stats-cards">
        <div class="stat-card gray">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Jami hodisalar</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
            </div>
            <div class="stat-value">10</div>
        </div>

        <div class="stat-card green">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Vazifa yaratilgan</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Holat o'zgarishlari</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Tayinlanganlar</div>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
            <div class="stat-value">0</div>
        </div>
    </div>

    <div class="search-filter-bar">
        <form method="GET" action="{{ route('task-history.index') }}">
            <div class="search-filter-container">

                <div class="search-input">
                    <i class="fa-solid fa-search"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Vazifa, foydalanuvchi bo'yicha qidirish...">
                </div>

                <div class="filter-button">
                    <i class="bi bi-funnel"></i>

                    <select name="position" class="filter-select" onchange="this.form.submit()">
                        <option value="">Barcha amallar</option>
                        @foreach([
                            2 => 'Vazifa yaratildi',
                            3 => 'Holat o‘zgartirildi',
                            4 => 'Foydalanuvchi biriktirildi',
                            5 => 'Foydalanuvchi olib tashlandi',
                            6 => 'Vazifa yangilandi',
                            7 => 'Vazifa tugash sanasi o‘zgartirildi'
                        ] as $value => $label)
                            <option value="{{ $value }}" {{ request('position') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </form>
    </div>

    <div id="tasks-list" class="tasks-list-container">
        @forelse($tasks as $task)
            <div class="task-item" id="task-{{ $task->id }}">

                <div class="task-icon">
                    <i class="fa-solid fa-pencil-square"></i>
                </div>

                <div class="task-content">
                    <h5 class="task-title">
                        <a href="{{ route('tasks.detail', $task->id) }}"> {{ $task->name ?? "Noma'lum vazifa" }}
                        </a>
                    </h5>
                    <div class="task-meta">
                        <div class="task-user">
                            <div class="user-avatar-small"> {{ strtoupper(substr($task->user->name ?? 'N', 0, 1)) }}
                            </div>

                            <span class="task-username"> {{ $task->user->name ?? "Noma'lum foydalanuvchi" }} </span>
                        </div>
                        <div class="task-date">
                            <i class="fa-solid fa-calendar"></i>
                            <span> {{ $task->end_date ?? '—' }} </span>
                        </div>
                    </div>
                </div>
                @php
                    $statusValue = is_object($task->status) ? $task->status->value : $task->status;
                    $status = match($statusValue) {
                        1 => ['class' => 'pending', 'text' => 'Pending'],
                        2 => ['class' => 'in-progress', 'text' => 'In Progress'],
                        3 => ['class' => 'done', 'text' => 'Done'],
                        default => ['class' => 'updated', 'text' => 'Updated'],
                               };
                @endphp
                <span class="status-badge {{ $status['class'] }}"> {{ $status['text'] }} </span>

            </div>
        @empty
            <div class="text-center p-4">
                <i class="bi bi-inbox" style="font-size: 40px;"></i>
                <p class="mt-2">Hozircha vazifalar mavjud emas</p>
            </div>

        @endforelse

    </div>

@endsection


