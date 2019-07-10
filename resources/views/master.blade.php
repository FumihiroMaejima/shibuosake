<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Shibuya - osake</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body>
<header class="global-header">
    <section class="header-text">
        <h1><a href="{{ route('mainPage') }}">Shibuya no Osake Site</a></h1>
        <div class="tag-line">渋谷の居酒屋一覧</div>
    </section>
</header>

<main id="app" class="container">
    @yield('content')
</main>

<div id="page_top"><a href="#"></a></div>

<footer>
    <address>Copyright(C)2019 calicocat.tokyo,Allright Reserved.</address>
</footer>

<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
