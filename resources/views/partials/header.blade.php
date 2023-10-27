<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/adminlte.min.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <title>Form</title>
</head>
<body>
<header>
    <div class="header_wrap">
        <div class="logo">
            <a href="https://www.azuf.az/" class="logo__link">
                <img class="logo_img" src="{{asset('/img/logo.webp')}}" alt="logo">
            </a>
        </div>
        <div class="language">
            <div class="language__links">
                @if(session()->has('locale'))
                    @if(session('locale') !== 'az')
                        <a href="{{route('locale', 'az')}}">AZ</a>
                    @endif
                    @if(session('locale') !== 'ru')
                        <a href="{{route('locale', 'ru')}}">RU</a>
                    @endif
                    @if(session('locale') !== 'en')
                        <a href="{{route('locale', 'en')}}">EN</a>
                    @endif
                @else
                    <a href="{{route('locale', 'ru')}}">RU</a>
                    <a href="{{route('locale', 'en')}}">EN</a>
                @endif
            </div>
        </div>
    </div>
</header>
