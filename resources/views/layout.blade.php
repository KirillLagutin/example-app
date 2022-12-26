<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>

<body class="bg-dark text-white">
    
    <div class="d-flex flex-column flex-md-row align-items-center bg-dark text-white p-3 px-mb-4 mb-3 border-bottom">
      <a href="/" class="d-flex align-items-center text-white text-decoration-none">
        <span class="fs-4">Пример</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-white text-decoration-none" href="/">Главная</a>
        <a class="me-3 py-2 text-white text-decoration-none" href="/about">О нас</a>
      </nav>
      <a class="btn btn-warning" href="/review">Отзывы</a>
    </div>

    <div class="container">
        @yield('main_content')
    </div>

</body>
</html>