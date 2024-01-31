<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="jetbrains://php-storm/navigate/reference?project=TPA&path=resources/views/app.css">
    <title>@yield('title')</title>
</head>
<body>
<nav>
        @yield('nav')
</nav>

<header>
    <h1>Mon Site</h1>
</header>

<div class="content">
    @yield('content')
</div>

<footer>
    <p>&copy; 2023 Mon Site</p>
</footer>
</body>
</html>
