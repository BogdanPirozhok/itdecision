<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('library/img/favicon.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('library/img/favicon.png') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('library/css/signin.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/css/notify.css') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
</head>

<body>
    <div class="cont" id="login">
        <div class="demo">
            <div class="login">
                <div class="login__check"></div>
                <div class="login__form">
                    <login-form token="{{ csrf_token() }}" path="{{ route('login') }}"></login-form>
                </div>
            </div>
        </div>
        <div class="error-container"></div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('library/js/notify.js') }}"></script>

    <script src="{{ asset('assets/js/manifest.js') }}"></script>
    <script src="{{ asset('assets/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/js/login.js?v=2') }}"></script>
</body>
</html>
