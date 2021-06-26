<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <title>@yield('title', 'Admin')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('header.top')
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/custom.css">
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="/js/app.js"></script>

    @stack('header.bottom')

</head>
<body>


<style>

    .loading {
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        z-index: 9999;
        display: flex;
        justify-content: center;
    }
    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 110px;
        height: 110px;
        align-self: center;
    }
    .lds-ripple div {
        position: absolute;
        border: 4px solid #FB5A00;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
    }
    @keyframes lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }
        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
    }

    .form-check-label {
        margin-right: 50px;
    }

    .imgDestroyBtn {
        position: relative;
        top: 30px;
        left: 10px;
        color: red;
        background-color: white;
        padding: 5px;
        border-radius: 50%;
    }
    .imgDestroyBtn:hover {
        cursor: pointer;
    }

</style>
<div class="loading">
    <div class="lds-ripple"><div></div><div></div></div>
</div>

<div class="main-wrapper">

    <div class="header">
        <div class="header-left">
            <a href="/" class="logo">
                <img src="/assets/img/logo.png" width="35" height="35" alt=""> <span>Admin</span>
            </a>
        </div>
        <div class="menubar">
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        </div>
        {{--<div class="searchbar">
            <form class="form-inline my-1 w-25 float-left">
                <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search...">
            </form>
        </div>--}}
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown d-none d-sm-block">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span
                        class="badge badge-pill bg-primary float-right">1</span></a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span>Bildirimler</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media">
                                        <span class="avatar">T</span> <!-- Alert icon -->
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">Test bildirim</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">30 Dk Önce</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="activities.html">Hepsini okundu işaretle</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                    <span class="user-img"><img class="rounded-circle" src="/assets/img/user.jpg" width="40" alt="Admin">
                    <span class="status online"></span></span>
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">{{ __('Çıkış') }}</a>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                    class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">{{ __('Çıkış') }}</a>
            </div>
        </div>
    </div>
