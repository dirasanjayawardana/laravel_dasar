{{-- View ini akan otomatis ditampilkan ketika terjadi HttpException dengan status code 5xx, seperti 501, 502 dsb --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- menampilkan pesan exceptionnya --}}
    <h1>Internal Server Error : {{ $exception->getMessage() }}</h1>
</body>

</html>
