@extends('layouts.app')
@section('title', 'Vazifa tafsilotlari')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/detail.css') }}">
@endpush

@section('content')
    <div class="container mt-4 mb-5">

        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('tasks.index') }}" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i> Vazifalar ro'yxatiga qaytish
                </a>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <h2 class="h3 mb-3">{{ $task->name ?? '-' }}</h2>

                            <div class="d-flex gap-4 meta-info">
                            <span>
                                <i class="fa-solid fa-calendar"></i> Yaratilgan:
                                {{ $task->created_at }}
                            </span>

                                <span>
                                <i class="fa-solid fa-person"></i> Yaratuvchi: {{ $task->creator->name ?? 'Noma’lum' }}
                            </span>

                                <span>
                                <i class="fa-solid fa-clock"></i> Tugash muddati:
                                {{ $task->end_date ?? 'Belgilanmagan' }}
                            </span>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mb-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>

                        <ul class="nav nav-tabs mb-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details" type="button" role="tab">
                                    <i class="fa-solid fa-comment"></i> Tafsilotlar va Izohlar
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="history-tab" data-bs-toggle="tab"
                                        data-bs-target="#history" type="button" role="tab">
                                    <i class="fa-solid fa-history"></i> Tarix ({{ 0 }})
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="mb-4">
                                    <h5 class="mb-3">Tavsif</h5>
                                    <p class="text-muted">{{ $task->description ?? 'Tavsif mavjud emas' }}</p>
                                </div>

                                <div>
                                    <h5 class="mb-3">Izohlar</h5>
                                    <div class="mb-4">
                                        @foreach($task->comments ?? [] as $comment)
                                            <div class="comment-item mb-3">
                                                <div class="d-flex gap-3">
                                                    <div class="user-avatar">{{ strtoupper(substr($comment->user->name ?? 'N', 0, 1)) }}</div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold">{{ $comment->user->name ?? 'Noma’lum' }}</div>
                                                        <div class="text-muted small mb-2">{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : '-' }}</div>
                                                        <div>{{ $comment->content }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($errors->any())
                                        @foreach ($errors->all() as $errors)
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    <li>{{ $errors }}</li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @endif
                                    <form action="{{ route('tasks.comment', $task->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea class="form-control" name="comment" rows="3" placeholder="Izoh qo'shish..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Izoh yuborish</button>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="history" role="tabpanel">
                                @foreach($task->history ?? [] as $event)
                                    <div class="timeline-item d-flex justify-content-between">
                                        <span>{{ $event->title ?? '-' }}</span>
                                        <span>{{ $event->created_at ? $event->created_at->format('d/m/Y') : '-' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Holat</h6>
                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Bajarilmagan</option>
                                <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Jarayonda</option>
                                <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Bajarildi</option>
                            </select>

                        </form>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Mas'ul shaxs</h6>

                        @if($task->user)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="user-avatar">{{ strtoupper(substr($task->user->name ?? 'N', 0, 1)) }}</div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $task->user->name ?? 'Noma’lum' }}</div>
                                    <div class="text-muted small">Jamoa a'zosi</div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-4">

                                <a href="{{ route('user.edit', $task->user->id) }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    O`zgartirish
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                <form action="{{ route('user.destroy', $task->user->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Foydalanuvchini o‘chirishni xohlaysizmi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        O`chirish
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        @else
                            <span class="text-muted">Biriktirilmagan</span>
                        @endif
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Vaqt chizig'i</h6>
                        <div class="timeline-item d-flex justify-content-between">
                            <span>Yaratilgan</span>
                            <span>{{ $task->created_at ? $task->created_at->format('d/m/Y') : '-' }}</span>
                        </div>

                        <div class="timeline-item d-flex justify-content-between">
                            <span>Tugash muddati</span>
                            <span>{{ $task->end_date ?? 'Belgilanmagan' }}</span>
                        </div>

                        <div class="timeline-item d-flex justify-content-between">
                            <span>Oxirgi yangilangan</span>
                            <span>{{ $task->updated_at ? $task->updated_at->format('d/m/Y') : '-' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
