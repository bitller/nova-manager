@extends('layouts.landing')
@section('content')
    <div class="first-section">
        <div class="container">
            <h2 class="text-center welcome-text">Aplicația dedicată reprezentanților Avon.</h2>
            <div class="col md-12 text-center image-video-container">
                <img src="http://placehold.it/800x400">
            </div>
        </div>
    </div>


    <div class="fluid-container second-section">

        <div class="row">

            <div class="col-md-12 text-center">
                <img src="{{ url('/img/star.svg') }}">
            </div>

            <div class="col-md-4 col-md-offset-4 text-center">
                <h3 class="free-text grey-dark">Primele 90 de zile gratuit!</h3>
                <h4 class="free-text-description grey">Primele 90 de zile sunt gratuite. Exact, 90 de zile în care te vei convinge că Nova este aplicația special creată pentru tine. Înscrie-te acum, durează 30 de secunde.</h4>
            </div>


            <div class="col-md-4 col-md-offset-4 big-button-container">
                <a class="no-underline-href" href="/register"><div class="btn btn-block btn-primary big-button">Începe să folosești Nova gratuit!</div></a>
            </div>



        </div>
    </div>

    <!-- BEGIN Campaign statistics -->
    <div class="container-fluid campaign-statistics">

        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                <!-- BEGIN Feature title and description -->
                <div class="col-md-8">

                    <!-- BEGIN Feature title -->
                    <div class="row">
                        <h3 class="grey-dark">Statistici pentru fiecare campanie.</h3>
                    </div>
                    <!-- END Feature title -->

                    <!-- BEGIN Feature description -->
                    <div class="row">
                        <h4 class="grey">Ai la dispoziție statistici pentru fiecare campanie în parte. Deasemenea, poți compara două campanii pentru a vedea diferențele.</h4>
                    </div>
                    <!-- END Feature description -->

                </div>
                <!-- END Feature title and description -->

                <!-- BEGIN Feature image -->
                <div class="col-md-3 col-md-offset-1">
                    <img src="{{ url('/img/stats.svg') }}">
                </div>
                <!-- END Feature image -->

            </div>

        </div>

    </div>
    <!-- END Campaign statistics -->

    <!-- BEGIN Fast access to client history feature -->
    <div class="container-fluid client-history-feature">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                <div class="col-md-4">
                    <img class="img-responsive col-md-offset-1" src="{{ url('/img/easy-access.svg') }}" />
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <h3 class="col-md-11 col-md-offset-1 title grey-dark">Acces rapid la istoricul fiecărui client.</h3>
                    </div>
                    <div class="row">
                        <h4 class="col-md-11 col-md-offset-1 description grey">Pentru fiecare client în parte ai acces la numărul și suma totală a comenzilor efectuate, precum și numărul de produse comandate. Plus multe altele.</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END Fast access to client history feature -->

    <!-- BEGIN Customized bills for your clients feature -->
    <div class="container-fluid customized-bills-feature">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                <!-- BEGIN Feature title and description -->
                <div class="col-md-8">

                    <!-- BEGIN Feature title -->
                    <div class="row">
                        <h3 class="grey-dark">Facturi personalizate pentru clienții tăi.</h3>
                    </div>
                    <!-- END Feature title -->

                    <!-- BEGIN Feature description -->
                    <div class="row">
                        <h4 class="grey">Facturile sunt personalizate cu numele dumneavoastră, astfel denotă profesionalism și respect, două calități care contează tot mai mult în ochii cliențiilor.</h4>
                    </div>
                    <!-- END Feature description -->

                </div>
                <!-- END Feature title and description -->

                <!-- BEGIN Feature image -->
                <div class="col-md-3 col-md-offset-1">
                    <img src="{{ url('/img/news.svg') }}">
                </div>
                <!-- END Feature image -->

            </div>

        </div>
    </div>
    <!-- END Customized bills for your clients feature -->

    <!-- BEGIN Create bills in seconds and statistics features -->
    <div class="fluid-container create-bills-in-seconds-and-statistics-features">

        <div class="row">
            <div class="container text-center">
                <div class="col-md-4 col-md-offset-2">
                    <img src="{{ url('/img/time.svg') }}">
                    <h3 class="grey-dark">Generează facturi în câteva secunde.</h3>
                    <h5 class="grey">Adăugând produsele după codul din catalog îți perimte să generezi facturi pentru clienții tăi în câteva secunde. Timpul tău contează pentru noi.</h5>
                </div>
                <div class="col-md-4">
                    <img src="{{ url('/img/money.svg') }}">
                    <h3 class="grey-dark">Detalii despre încasările tale ca reprezentant.</h3>
                    <h5 class="grey">Ai la dispoziție detalii despre încasările efectuate, clienții care nu au plătit la timp și banii care urmează să îi primești. Toate astea pentru a vedea ce câștiguri îți aduce această meserie.</h5>
                </div>
            </div>
        </div>

    </div>
    <!-- END Create bills in seconds and statistics features -->

    <!-- BEGIN 30 seconds away -->
    <div class="fluid-container first-three-months-free">

        <div class="row">
            <div class="container">

            </div>
        </div>

    </div>
    <!-- END 30 seconds away -->
@endsection
