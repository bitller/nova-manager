<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta id="token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }} - Nova Manager</title>

    <link rel="stylesheet" type="text/css" href="/css/app.css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

    <!--[if lt IE 7]>
    <style type="text/css">
        #wrapper { height:100%; }
    </style>
    <![endif]-->

</head>

<body id="app">

<!-- BEGIN Wrapper -->
<div id="wrapper">

    <div id="header">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/dashboard">Nova</a>
                    </div>
                    <ul class="nav navbar-nav">

                        <li>
                            <a @click="loadAnnouncements" href="#" data-toggle="modal" data-target="#notifications"><span class="glyphicon glyphicon-bell animated infinite swing"></span></a>
                        </li>

                        <!-- BEGIN Bills-->
                        <li>
                            <a href="/dashboard/"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Facturi</a>
                        </li>
                        <!-- END Bills -->

                        <!-- BEGIN Clients -->
                        <li>
                            <a href="/dashboard/clients"><span class="glyphicon glyphicon-user"></span>&nbsp;Clienţi</a>
                        </li>
                        <!-- END Clients -->

                        <!-- BEGIN Products -->
                        <li>
                            <a href="/dashboard/products"><span class="glyphicon glyphicon-th"></span>&nbsp;Produse</a>
                        </li>
                        <!-- END Products -->

                        <!-- BEGIN Statistics -->
                        <li>
                            <a href="/dashboard/statistics"><span class="glyphicon glyphicon-stats"></span>&nbsp;Statistici</a>
                        </li>
                        <!-- END Statistics -->

                        <!-- BEGIN Help -->
                        <li>
                            <a href="/dashboard/support"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Ajutor</a>
                        </li>
                        <!-- END Help -->
                    </ul>

                    <!-- BEGIN Right content -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;
                                @if (isset($user)) {{ $user->email }} @endif
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @role('admin')
                                    <!-- BEGIN Admin center -->
                                    <li>
                                        <a href="/admin-center/users"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Centrul de administrare</a>
                                    </li>
                                    <!-- END Admin center -->
                                @endrole
                                <!-- BEGIN Settings -->
                                <li>
                                    <a href="/dashboard/settings"><span class="glyphicon glyphicon-cog"></span>&nbsp;Setarile contului</a>
                                </li>
                                <!-- END Settings -->
                                <li class="divider"></li>
                                <!-- BEGIN Log out -->
                                <li>
                                    <a href="/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Deconectare</a>
                                </li>
                                <!-- END Log out -->
                            </ul>
                        </li>
                    </ul>
                    <!-- END Right content -->

                </div>
            </div>
        </nav>
    </div>

    <div id="content">
        <div class="container">
            @yield('content')
            <notifications></notifications>
        </div>
    </div>

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center footer-text">2016 - Toate drepturile rezervate.</div>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
    @yield('scripts')
</div>
<!-- END Wrapper -->

</body>

</html>
