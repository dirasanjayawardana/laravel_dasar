<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Say Hello</title>
</head>

<body>
    {{-- ketika disubmit akan menuju route /form dengan method post --}}
    <form action="/form" method="POST">
        <label for="name">
            <input type="text" name="name">
        </label>
        <input type="submit" value="Say Hello">

        {{-- menambahkan csrf token --}}
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        {{-- untuk request dengan ajax, tambahkan X-CSRF-TOKEN di header --}}
    </form>
</body>

</html>
