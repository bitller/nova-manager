<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Bill owner and bill campaign -->
            <div class="col-md-9">
                <div class="col-md-2">
                    <img class="client-picture" src="http://lorempixel.com/70/70" />
                </div>
                <div class="col-md-10 bill-details">
                    <span class="page-title grey-dark">John Doe</span>
                    <span class="page-description grey">Comanda 1 din campania <a href="#">4/2016</a>
                </div>
            </div>
            <!-- END Bill owner and bill campaign -->

            <!-- BEGIN Buttons -->
            <div class="col-md-3">
                <div class="btn btn-info"><span class="glyphicon glyphicon-print"></span></div>
                <div class="btn btn-info"><span class="glyphicon glyphicon-cog"></span></div>
                <div class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Adaugă produs</div>
            </div>
            <!-- END Buttons -->

            <div class="col-md-12 alerts">

                <!-- BEGIN Payment term not set alert -->
                <div class="alert alert-warning">
                    Seteaza termenul de plata pentru aceasta factura.
                </div>
                <!-- END Payment term not set alert -->

                <!-- BEGIN Payment term expired -->
                <div class="alert alert-danger">
                    Aceasta factura trebuia platita pana in data de 9.03.2016.
                </div>
                <!-- END Payment term expired -->

            </div>

        </div>
    </div>

</template>

<script>

export default {
    //
}

</script>
