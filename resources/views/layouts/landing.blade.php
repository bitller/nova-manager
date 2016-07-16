<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>

<body>

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
                {{--<li>--}}
                {{--<a href="#">{{ trans('welcome.pricing') }}</a>--}}
                {{--</li>--}}
                <li>
                    <p class="navbar-btn">
                        <a href="/login" class="btn custom-button">Conectează-te</a>
                    </p>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div id="startchange">

    @yield('content')

    <!-- BEGIN Footer -->
    <div class="fluid-container footer">

        <div class="row">
            <div class="container">

                <!-- BEGIN Nova -->
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                    <h3>Nova</h3>
                    <h5>Creată cu pasiune în Europa de:</h5>
                    <h5>Bitller S.R.L.</h5>
                    <h5>Cod Unic de Înregistrare: 12345678</h5>
                </div>
                <!-- END Nova -->

                <!-- BEGIN Contact -->
                <div class="col-xs-6 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
                    <h3>Contact</h3>
                    <h5><a href="mailto:contact@nova-manager.com">contact@nova-manager.com</a></h5>
                    <h5>Strada Caragiale 44</h5>
                    <h5>Bl. 4 Ap. 8, 259196</h5>
                    <h5>Timișoara, România</h5>
                </div>
                <!-- END Contact -->

                <!-- BEGIN About and legal -->
                <div class="col-xs-6 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-3 col-lg-3">
                    <h3>Legal</h3>
                    <h5><a href="/pricing">Prețuri</a></h5>
                    <h5><a href="/terms-and-conditions">Termeni și condiții</a></h5>
                    <h5><a href="/privacy">Politică de confidențialitate</a></h5>
                    <h5><a href="/imprint">Date fisacle</a></h5>
                </div>
                <!-- END About and legal -->
            </div>

        </div>

    </div>
    <!-- END Footer -->

</div>

<script src="/js/vendor.js"></script>
<script src="js/welcome.js"></script>

</body>

</html>
