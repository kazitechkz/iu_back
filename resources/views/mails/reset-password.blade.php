<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
    <style>
        /* Reset CSS */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        /* Container */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        /* Logo */
        .logo {
            width: 150px;
            height: auto;
        }
        /* Content */
        .content {
            margin-bottom: 20px;
        }
        /* Button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        /* Footer */
        .footer {
            text-align: center;
            font-size: 0.8em;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="https://iunion.s3.ap-south-1.amazonaws.com/iu_test_logo_for_mail_template.jpg" alt="Logo" class="logo">
        <h2>Восстановить пароль</h2>
    </div>
    <div class="content">
        <p>Привет, {{$data['name']}}</p>
        <p>Мы получили запрос на изменение пароля для вашей учетной записи iU-test.</p>
        <p>Введите код ниже, чтобы подтвердить это действие:</p>
        <a href="javascript:void(0)" class="btn">{{$data['code']}}</a>
    </div>
    <div class="footer">
        <p>This email was sent automatically, please do not reply to it.</p>
        <p>&copy; 2024 iU-test. All rights reserved.</p>
    </div>
</div>
</body>
</html>
