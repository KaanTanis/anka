<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Arquito - 3D Architecture &amp; Interior HTML Template">
    <meta name="author" content="Paul, Logan Cee, Mikhail Ojereliev">
    <title>@yield('title', 'Adanorm')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Teko:300,400" rel="stylesheet">

    <link href="/front/assets/css/icofont.min.css" rel="stylesheet">
    <link href="/front/assets/css/linearicons.min.css" rel="stylesheet">
    <link href="/front/assets/css/magnific-popup.min.css" rel="stylesheet">
    <link href="/front/assets/css/animsition.min.css" rel="stylesheet">
    <link href="/front/assets/css/swiper.min.css" rel="stylesheet">
    <link href="/front/assets/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/front/assets/css/revolution/settings.css">
    <link rel="stylesheet" href="/front/assets/css/revolution/layers.css">

    <link rel="stylesheet" href="/front/assets/css/revolution-addons/panorama/revolution.addon.panorama.css">

    <link href="/front/assets/css/theme.css" rel="stylesheet">
    <link href="/front/assets/css/responsive.css" rel="stylesheet">
    <link href="/front/assets/css/dark.css" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/front/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/front/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/front/favicons/favicon-16x16.png">
    <link rel="manifest" href="/front/favicons/site.html">
    <link rel="mask-icon" href="/front/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/front/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <script src="/js/app.js"></script>
    @stack('header')
</head>
<body class="page">
<div style="display: none">
    <svg xmlns="http://www.w3.org/2000/svg" style="width:0; height:0; visibility:hidden;">
        <symbol id="icon_ion-icon-apps" viewBox="0 0 512 512">
            <path d="M96 176h80V96H96v80zm120 240h80v-80h-80v80zm-120 0h80v-80H96v80zm0-120h80v-80H96v80zm120 0h80v-80h-80v80zM336 96v80h80V96h-80zm-120 80h80V96h-80v80zm120 120h80v-80h-80v80zm0 120h80v-80h-80v80z"/>
        </symbol>
    </svg>
</div>
<div class="page__inner animsition">
    <header class="header header_white header_fixed ">
        <div class="header__container" style="padding-top: 10px !important;">
            <div class="header__wrapper container-fluid">
                <div class="header__inner"><a href="/" class="logo header__logo">
                        <img src="/a-logo.png" alt="" style="height: 60px">
                    </a>
                    <button type="button" class="header__menu-button"><span class="header__menu-button-inner"></span>
                    </button>
                </div>
            </div>
            <div class="header-full-page">
                <div class="header-full-page__bottom container">
                    <ul class="top-menu header-full-page__menu">
                        <li class="top-menu__menu-item">
                            <div><a href="/"
                                 class="dropdown__trigger top-menu__menu-link">Ana Sayfa</a>
                            </div>
                        </li>
                        <li class="top-menu__menu-item">
                            <div><a href="{{ \App\Helper::pageSlug(4) }}"
                                    class="dropdown__trigger top-menu__menu-link">Hakkımızda</a>
                            </div>
                        </li>
                        <li class="top-menu__menu-item">
                            <div><a href="{{ route('user.projects') }}"
                                    class="dropdown__trigger top-menu__menu-link">Projeler</a>
                            </div>
                        </li>
                        <li class="top-menu__menu-item">
                            <div><a href="{{ route('user.contact') }}"
                                    class="dropdown__trigger top-menu__menu-link">İletişim</a>
                            </div>
                        </li>
                    </ul>
                    <div class="header-full-page__contacts"><span>İletişim:</span> <a href="tel:+90 322 233 0933">+90 322 233 0933</a></div>
                </div>
            </div>
        </div>
        <div class="header__overlay"></div>
        <div class="menu-panel header__menu">
            <div class="menu-panel__inner">
                <button type="button" class="header__menu-button header__menu-button_fixed"><span
                        class="header__menu-button-inner"></span></button>
                {{--<div class="menu-panel__locales">
                    <div class="menu-panel__locale link link link_active">En</div>
                    <div class="menu-panel__locale link">Fr</div>
                    <div class="menu-panel__locale link">De</div>
                </div>--}}
                <div class="menu-panel__menu">
                    <div class="menu-panel__menu-item">
                        <a href="/" data-toggle="collapse"
                           class="menu-panel__menu-link menu-panel__menu-link menu-panel__menu-link_active">Ana Sayfa</a>
                    </div>

                    <div class="menu-panel__menu-item">
                        <a href="{{ \App\Helper::pageSlug(4) }}" data-toggle="collapse"
                           class="menu-panel__menu-link menu-panel__menu-link menu-panel__menu-link_active">Hakkımızda</a>
                    </div>

                    <div class="menu-panel__menu-item">
                        <a href="{{ route('user.projects') }}" data-toggle="collapse"
                           class="menu-panel__menu-link menu-panel__menu-link menu-panel__menu-link_active">Projeler</a>
                    </div>

                    <div class="menu-panel__menu-item">
                        <a href="{{ route('user.contact') }}" data-toggle="collapse"
                           class="menu-panel__menu-link menu-panel__menu-link menu-panel__menu-link_active">İletişim</a>
                    </div>
                </div>
                <div class="menu-panel__footer">
                    <div class="socials menu-panel__socials"><a href="#" class="socials__social icofont-twitter">
                            <div class="visually-hidden">twitter</div>
                        </a><a href="#" class="socials__social icofont-facebook">
                            <div class="visually-hidden">facebook</div>
                        </a><a href="#" class="socials__social icofont-google-plus">
                            <div class="visually-hidden">google plus</div>
                        </a></div>
                    <div class="menu-panel__bottom">
                        <div class="menu-panel__copyright">© {{ date('Y') }} <strong>{{ config('app.name') }}.</strong> All Rights Reserved.</div>
                        <div class="menu-panel__author">Designed by <a href="//bilgibahcesi.com">bilgibahcesi.com</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
