<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

</head>
<body style="display: flex; flex-direction: column;">

    <a href="{{route('categories')}}">Панель управления - категории</a>
    <a href="{{route('products')}}">Панель управления - товары</a>

    @include('categories')

    @include('filters')
    
    @yield('index')
    
</body>
</html>