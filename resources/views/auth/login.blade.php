<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .btn-outline-primary,
        .btn-outline-secondary {
            border-top: none;
            border-right: none;
            border-left: none;
            border-radius: 0;
            padding: 10px;
        }

        .p-icon i {
            font-size: 30px;
            padding: 20px;
            background: lightcyan;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 text-center mt-5">
            <button type="button" class="btn btn-primary btn-ld h-50 w-15"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
            </button>
            <h4 class="box">Xush kelibsiz</h4>
            <h6>Davom etish uchun tizimga kiring</h6>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="btn-group">
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">Parol bilan kirish </a>
                    <a href="{{ route('login-by-email') }}" class="btn btn-outline-primary">Email kod bilan kirish</a>
                </div>
                <div class="body p-3">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->getMessages() as $field => $messages)
                                @if (!in_array($field, ['username', 'password']))
                                    @foreach ($messages as $error)
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                <li>{{ $error }}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        <div class="mb-3">
                            <label for="username" class="form-label">Foydalanuvchi nomi yoki Email</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username yoki Email" value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Parol</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Parol">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Kirish</button>
                            <hr>
                            <div>
                                <h6 class="text-center fw-light">Hisobingiz yo`qmi?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Ro`yhatdan o`tish</a>
                                </h6>
                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
