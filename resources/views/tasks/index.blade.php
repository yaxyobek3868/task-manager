@extends('layouts.app')

@section('title', 'Vazifalar')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/task.css') }}">
@endpush

@section('content')

    <div class="page-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div>
                <h1>Vazifalar</h1>
                <p>Barcha vazifalarni boshqaring va kuzating</p>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn-create-task" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                <span>Vazifa yaratish</span>
            </button>
        </div>
    </div>


    @if(session('success'))
        <div class="alert-custom">
            <i class="bi bi-check-circle-fill"></i>
            <div class="flex-grow-1">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="stats-cards">
            <div class="stat-card all" onclick="filterTasks(0)">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Barcha vazifalar</div>
                    </div>
                </div>
                <div class="stat-value">5</div>
            </div>

            <div class="stat-card pending" onclick="filterTasks(1)">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Kutilmoqda</div>
                    </div>

                </div>
                <div class="stat-value">2</div>
            </div>

            <div class="stat-card completed" onclick="filterTasks(2)">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Jarayonda</div>
                    </div>
                </div>
                <div class="stat-value">2</div>
            </div>

            <div class="stat-card completed" onclick="filterTasks(3)">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Bajarildi</div>
                    </div>
                </div>
                <div class="stat-value">1</div>
            </div>
        </div>


    @foreach($tasks as $task)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-2">{{ $task->name }}</h5>
                        <p class="card-text text-muted mb-3">{{ $task->description }}</p>
                    </div>

                    @if($task->status->isPending())
                        <span class="badge bg-primary">
                            <i class="fa-solid fa-check"></i> <strong>Pending</strong>
                        </span>
                    @endif

                    @if($task->status->isInProgress())
                        <span class="badge bg-warning">
                            <i class="fa-solid fa-play"></i> <strong>In Prosessing</strong>
                        </span>
                    @endif

                    @if($task->status->isDone())
                        <span class="badge bg-success">
                            <i class="fa-solid fa-clock"></i> <strong>Done</strong>
                        </span>
                    @endif
                </div>

                <div class="d-flex flex-wrap gap-3 text-sm">
                    <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-person me-1"></i>
                        <span>{{ $task->assigned_to ?? 'John Doe' }}</span>
                    </div>

                    <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        <span>Due {{ $task->end_date }}</span>
                    </div>

                    <div class="d-flex align-items-center text-muted">
                        <span>Created by {{ $task->created_by }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">
                        <i class="bi bi-plus-circle me-2 text-primary"></i>
                        Yangi vazifa yaratish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="taskName" class="form-label">
                                Vazifa nomi <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="taskName"
                                   name="name"
                                   placeholder="Vazifa nomini kiriting"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">
                                Tavsif <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control"
                                      id="taskDescription"
                                      name="description"
                                      rows="4"
                                      placeholder="Vazifani batafsil tavsiflang"
                                      required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="assignUser" class="form-label">
                                Foydalanuvchiga biriktirish
                            </label>
                            <select class="form-select" id="assignUser" name="user_id">
                                <option value="">Biriktirilmagan</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="taskStatus" class="form-label">Holat</label>
                                <select class="form-select" id="taskStatus" name="status">
                                    <option value="1">Kutilmoqda</option>
                                    <option value="2">Jarayonda</option>
                                    <option value="3">Bajarildi</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="dueDate" class="form-label">Tugash sanasi</label>
                                <input type="date"
                                       class="form-control"
                                       id="dueDate"
                                       name="due_date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Bekor qilish
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            Vazifa yaratish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function filterTasks(status) {
            console.log('Filter:', status);

            const url = new URL(window.location.href);
            if (status === 0) {
                url.searchParams.delete('status');
            } else {
                url.searchParams.set('status', status);
            }
            window.location.href = url.toString();
        }
    </script>
@endpush
