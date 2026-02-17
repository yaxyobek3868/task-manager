@extends('layouts.app')

@section('title', 'Vazifalar')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/task.css') }}">
@endpush

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div>
                <h1>Vazifalar</h1>
                <p>Barcha vazifalarni boshqaring va kuzating</p>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn-create-task" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                <i class="fa-solid fa-plus-circle me-2 "></i>
                <span>Vazifa yaratish</span>
            </button>
        </div>
    </div>

    <div class="stats-cards">

            <div class="stat-card all js_btn" data-status=0>
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Barcha vazifalar</div>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['total'] }}</div>
            </div>

            <div class="stat-card pending js_btn" data-status=1>
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Kutilmoqda</div>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
            </div>

            <div class="stat-card completed js_btn" data-status=2>
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Jarayonda</div>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['in_progress'] }}</div>
            </div>

            <div class="stat-card completed js_btn" data-status=3>
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Bajarildi</div>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['done'] }}</div>
            </div>
        </div>


    @foreach($tasks as $task)
        <a href="{{ route('tasks.detail', $task['id']) }}" class="card mb-3 shadow-sm text-decoration-none text-dark">
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
                        <i class="fa-solid fa-play"></i> <strong>In Progress</strong>
                    </span>
                    @endif

                    @if($task->status->isDone())
                        <span class="badge bg-success">
                        <i class="fa-solid fa-clock"></i> <strong>Done</strong>
                    </span>
                    @endif
                </div>

                <div class="d-flex flex-wrap gap-3 text-sm">
                    <div>
                        <i class="fa-solid fa-user"></i>
                        <span>{{ $task->user->name ?? 'John Doe' }}</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-calendar"></i>
                        <span>Due {{ $task->end_date }}</span>
                    </div>

                    <div>
                        <span>Created by {{ $task->creator->name ?? "" }}</span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach


    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">
                        <i class="fa-solid fa-plus-circle me-2 text-primary"></i>
                        Yangi vazifa yaratish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" id="js_store_task_form" method="POST">
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
                                   >
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
                                      ></textarea>
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
                                <label for="end_date" class="form-label">Tugash sanasi</label>
                                <input type="date"
                                       class="form-control"
                                       id="end_date"
                                       name="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Bekor qilish
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-check me-1"></i>
                            Vazifa yaratish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="application/javascript">

        document.querySelectorAll('.js_btn').forEach(function (el) {

            el.addEventListener('click', function () {

                let status = this.dataset.status;
                let baseUrl = "{{ route('tasks.index') }}";

                window.location.href = status && status !== "0"
                    ? `${baseUrl}/${status}`
                    : baseUrl;
            });

        });


        document.querySelectorAll('#js_store_task_form').forEach(function (el) {

            el.addEventListener('submit', function (e) {
                e.preventDefault();

                this.querySelectorAll('.is-invalid').forEach(input => {
                    input.classList.remove('is-invalid');
                });
                this.querySelectorAll('.invalid-feedback').forEach(feedback => {
                    feedback.remove();
                });

                const formData = new FormData(this);

                fetch(this.action, {
                    method: this.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === true) {
                            // Modalni yopish
                            const modal = this.closest('.modal');
                            if(modal) {
                                // agar Bootstrap 5 bo'lsa
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();
                            }

                            window.location.reload();
                        } else if (response.status === 422) {

                            const errors = data.errors;
                            for (let key in errors) {
                                const input = this.querySelector(`[name="${key}"]`);
                                if (input) {
                                    input.classList.add('is-invalid');

                                    // Bootstrap 5 uchun invalid-feedback qo'shish
                                    const errorDiv = document.createElement('div');
                                    errorDiv.classList.add('invalid-feedback');
                                    errorDiv.innerText = errors[key][0];
                                    input.insertAdjacentElement('afterend', errorDiv);
                                }
                            }
                        else {
                            console.log('Error:', data);
                        }
                    })
                    .catch(error => console.error('Fetch Error:', error));


            });

        });


    </script>
@endpush
