@extends('layouts.app')
@section('title', 'Vazifani tahrirlash')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/detail.css') }}">
@endpush

@section('content')
    <div class="container mt-4 mb-5">

        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('tasks.detail', $task->id) }}" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i> Orqaga qaytish
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Vazifani tahrirlash</h4>
                        <form action="{{ route('tasks.tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Vazifa nomi</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $task->name) }}"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tavsif</label>
                                <textarea name="description"
                                          class="form-control"
                                          rows="4">{{ old('description', $task->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tugash muddati</label>
                                <input type="date"
                                       name="end_date"
                                       class="form-control"
                                       value="{{ old('end_date', optional($task->end_date)->format('Y-m-d')) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Holat</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Bajarilmagan</option>
                                    <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Jarayonda</option>
                                    <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Bajarildi</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Mas'ul shaxs</label>
                                <select name="user_id" class="form-select">
                                    <option value="">Tanlang</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Saqlash
                                </button>

                                <a href="{{ route('tasks.detail', $task->id) }}"
                                   class="btn btn-outline-secondary">
                                    Bekor qilish
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
