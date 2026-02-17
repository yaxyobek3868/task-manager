<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .fa-user {
            font-size: 20px;

        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 text-center mt-5">
            <button type="button" class="btn btn-primary btn-ld h-50 w-15">
                <i class="fa-solid fa-user"></i>
            </button>
            <h4 class="box">Hisob yaratish</h4>
            <h6>Boshlash uchun ro'yxatdan o'ting</h6>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="body p-3">

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Ism</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Ismingizni kiriting" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-2">
                                <label for="username" class="form-label">Foydalanuvchi nomi</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Foydalanuvchi nomini tanlang" value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email manzil</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="sizning@gamil.com" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Parol</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Parol yarating">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Parolni tasdiqlash</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Parolni qayta kiriting">
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Hisob yaratish</button>
                                <hr>
                                <div>
                                    <h6 class="text-center fw-light">Hisobingiz bormi?
                                        <a href="{{ route('login') }}">Kirish</a>
                                    </h6>
                                </div>
                            </div>
                        </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
