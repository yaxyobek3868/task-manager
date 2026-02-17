@extends('layouts.app')

@section('title', 'Foydalanuvchini O`zgartirish')

@section('content')
<div class="col-md-6">
    <h3>Foydalanuvchini O`zgartirish</h3>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Ism</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select name="role" id="role" class="form-control">
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Employee</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Saqlash</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Orqaga</a>
    </form>
</div>
@endsection
