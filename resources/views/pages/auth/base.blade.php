<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta id="token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
</head>

        <!-- BEGIN Register page -->
<body id="app" class="register-page">

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Nova</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-btn">
                        @if (isset($registerButton) && $registerButton)
                            <a href="/register" class="btn custom-button">{{ trans('login.join_nova') }}</a>
                        @else
                            <a href="/login" class="btn custom-button">Conectează-te</a>
                        @endif
                    </p>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<!-- BEGIN Top section -->
<div class="jumbotron custom-jumbotron top-part text-center">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <span class="first-text">{{ $firstText }}</span>
            <span class="short-description">{{ $shortDescription }}</span>
        </div>
    </div>
</div>
<!-- END Top section -->

<!-- BEGIN Register form -->
<div class="container" id="register">
    @yield('content')
</div>
<!-- END Register form -->

</body>
<!-- END Register page -->
<script src="/js/app.js"></script>
</html>