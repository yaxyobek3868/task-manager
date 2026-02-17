<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasdiqlash kodi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .content p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .code-box {
            background-color: #f8f9fa;
            border: 2px dashed #0d6efd;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            color: #0d6efd;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }
        .warning p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <div class="icon">🔒</div>
        <h1>Tasdiqlash kodi</h1>
    </div>

    <div class="content">
        <p>Salom!</p>
        <p>Tizimga kirish uchun quyidagi tasdiqlash kodini kiriting:</p>

        <div class="code-box">
            <div class="code">{{ $code }}</div>
        </div>

        <p>Bu kod <strong>10 daqiqa</strong> davomida amal qiladi.</p>

        <div class="warning">
            <p><strong> Xavfsizlik uchun eslatma:</strong></p>
            <p>Agar siz bu kodni so'ramagan bo'lsangiz, bu emailni e'tiborsiz qoldiring. Hech kimga bu kodni aytmang!</p>
        </div>
    </div>

    <div class="footer">
        <p>Bu avtomatik xabar. Javob yozish shart emas.</p>
        <p>© 2024 Task Management. Barcha huquqlar himoyalangan.</p>
    </div>
</div>
</body>
</html>
