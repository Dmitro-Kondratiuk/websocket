<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/chat/chat.js'])
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar a {
            color: #ffffff;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Навігація -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">My Laravel App</a>
        <ul class="navbar-nav ml-auto">
            @if(! \Illuminate\Support\Facades\Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Реєстрація</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}">Стоврити Пост</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('friends') }}">Друзі</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('chat.index') }}">Чати</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">Вийти</a></li>
            @endif
        </ul>
    </div>
</nav>

<!-- Основний контент -->
<div class="container">
    @yield('content')
</div>

<!-- Футер -->
<footer>
    <p>&copy; 2024 My Laravel App. Всі права захищено.</p>
</footer>

</body>
</html>
