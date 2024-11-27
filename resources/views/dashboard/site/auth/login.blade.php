<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('dashboard.Meem') | @lang('dashboard.Dashboard') | @lang('titles.Login')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .card {
            background: transparent !important;
            box-shadow: none
        }

        .login-card-body {
            background: transparent !important;
        }

        .forget {
            margin: 5% 0
        }

        .forget a {
            color: rgba(255, 32, 32, 1);
            font-size: 15px;
        }

        .btn-login {
            background: #525FE1;
            border-radius: 25px !important;
            padding: 2%;
            font-size: 18px;
            color: #fff
        }

        .btn-login:hover {
            color: #fff;
        }

        .btn-login {
            position: relative;
            height: 50px;
            width: 150px;
            color: #FFF;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 2px;
            background-color: #212121;
            transition: all 0.5s;
            border: none;
        }

        .btn-login::before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(82, 95, 225,.2);
            border-radius: 25px !important;
            border-radius: 5px;
            transition: all 0.3s;
            z-index: 1;

        }

        .btn-login:hover::before {
            opacity: 0;
            transform: scale(0.7, 0.7);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.4s;
            border: 1px solid rgba(29, 255, 86, 0.281);
            border-radius: 5px;
            transform: scale(1.5, 1.5);
            opacity: 0;
            z-index: 1;
        }

        .btn-login:hover::after {
            opacity: 1;
            transform: scale(1, 1);
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">@lang('dashboard.RMS') @lang('dashboard.Dashboard')</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    <img src="{{ asset('img/ELRYAD.png') }}" style="width: 250px" alt="">
                </p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="@lang('dashboard.Email')"
                            value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="@lang('dashboard.Password')">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p class="forget">
                        <a href="#" class="">@lang('dashboard.I forgot my password')</a>
                    </p>
                    <div>
                        <button type="submit" class="btn-login btn w-100 d-block">@lang('dashboard.Login')</button>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Validation -->
    @error('email')
        @include('dashboard.core.alerts.error', compact('message'))
    @enderror
    @error('password')
        @include('dashboard.core.alerts.error', compact('message'))
    @enderror

    @if (Session::has('error'))
        @include('dashboard.core.alerts.error', ['message' => Session::get('error')])
    @elseif(Session::has('success'))
        @include('dashboard.core.alerts.success', ['message' => Session::get('success')])
    @endif

</body>

</html>
