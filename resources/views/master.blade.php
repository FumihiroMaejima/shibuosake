<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>LaravelSample - お酒テスト</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <style>
        .tab_wrap{width:470px; margin:80px auto;}
        .tab_area{font-size:0; padding:0 55px;}
        .tab_area label{width:110px; display:inline-block; padding:14px 0 12px; color:#fff; background:#90c9cc; text-align:center; font-size:13px; cursor:pointer; transition:ease 0.2s opacity; border-top-left-radius:10px; border-top-right-radius:10px; vertical-align:bottom; transition:ease 0.2s; margin:10px 5px 0;}
        .tab_area label:hover{opacity:0.5;}
        .tab_panel{width:100%; padding:80px 0; opacity:0; display:none;}
        .tab_panel p{font-size:14px; letter-spacing:1px; text-align:center;}
        .panel_area{background:#ffffff; border-bottom-right-radius:10px; border-bottom-left-radius:10px; border-top:8px solid #d7e9ea;}
    </style>
</head>

<body>
<header class="global-header">
    <section class="header-text">
        <h1><a href="{{ route('mainPage') }}">お酒管理</a></h1>
        <div class="tag-line">お酒一覧だよ！！</div>
    </section>
</header>

<main id="app" class="container">
    @yield('content')
</main>

<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
