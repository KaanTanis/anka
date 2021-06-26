
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form action="" method="post">
                    @csrf
                    @if(session('message'))
                    <span style="color: #ff4646">{{ session('message') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" name="email" type="text" autofocus="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Şifre') }}</label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">{{ __('Giriş Yap') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
