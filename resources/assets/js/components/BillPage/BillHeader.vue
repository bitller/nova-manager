<style>

.options-menu {
    display: inline-block;
}

</style>
<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Bill owner and bill campaign -->
            <div class="col-md-9">
                <span class="page-title grey-dark">John Doe</span>
                <span class="page-description grey">Comanda 1 din campania <a href="#">4/2016</a>
            </div>
            <!-- END Bill owner and bill campaign -->

            <!-- BEGIN Buttons -->
            <div class="col-md-3">
                <div class="btn btn-info"><span class="glyphicon glyphicon-print"></span></div>
                <div class="dropdown options-menu">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-cog"></span>
                    </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-ok"></span>&nbsp;Marchează factura ca plătită</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Setează termenul de plată</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Editează detaliile suplimentare</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge factura</a></li>
                        </ul>
                </div>
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
