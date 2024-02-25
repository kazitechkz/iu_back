<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iU-test</title>
    {{--    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">
<div class="container">
    <img class="ax-center my-10 w-24" src="https://iutest.kz/assets/images/logo-white.png" />
    <div class="card p-6 p-lg-10 space-y-4">
        <h1 class="h3 fw-700">
            Восстановление пароля на сайте iUtest.kz!
        </h1>
        <p>
            Для завершения восстановлении на сайте введите ниже приведенный код:
        </p>
        <a href="javascript:void (0)" class="btn btn-primary p-3 fw-700 ax-center" style="font-size: 22px">{{$code}}</a>
    </div>
</div>
</body>
</html>
