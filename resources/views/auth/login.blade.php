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
        .fa-arrow-right-to-bracket {
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 text-center mt-5">
            <button type="button" class="btn btn-primary btn-ld h-50 w-15">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>

            <h4 class="box">Xush kelibsiz</h4>
            <h6>Davom etish uchun tizimga kiring</h6>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="btn-group">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Parol bilan kirish </a>
                    <a href="{{ route ('login-by-email')}}" class="btn btn-outline-secondary">Email kod bilan kirish</a>
                </div>
                <div class="body p-3">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Foydalanuvchi nomi yoki Email</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Foydalanavchini nomni kiriting">

                        </div>
                        <div class="mb-3">
                            <label for="parol" class="form-label">Parol</label>
                            <input type="password" class="form-control" name="password" id="parol" placeholder="Paraoligizni kiriting">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button">Kirish</button>
                            <hr>
                            <div>
                                <h6 class="text-center fw-light">Hisobingiz yo`qmi?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Ro`yhatdan o`tish</a>
                                </h6>
                            </div>
                            <div class="card">
                                <h6 class="text-start m-lg-3 fw-light">
                                    Demo ma'lumotlar: <br><br>

                                    <strong>Admin:</strong> admin / istalgan parol <br>
                                    <strong>Menejer:</strong> manager1 / istalgan parol <br>
                                    <strong>Foydalanuvchi:</strong> john_doe / istalgan parol <br>
                                    <hr>
                                    Email kirish: Faol foydalanuvchining emailidan foydalaning (admin@company.com)<br>
                                    Tasdiqlash kodi: 123456
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
