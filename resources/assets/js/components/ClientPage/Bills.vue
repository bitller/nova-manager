<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12"><span class="primary-title">Facturi</span></div>
        </div>

        <div class="col-md-12 white last">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <!-- BEGIN Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Numărul de produse</th>
                                <th class="text-center">Comanda</th>
                                <th class="text-center">Campania</th>
                                <th class="text-center">Preț</th>
                                <th class="text-center">Reducere oferită</th>
                                <th class="text-center">Achitată</th>
                                <th class="text-center">Accesează factura</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center vert-align">4</td>
                                <td class="text-center vert-align">1</td>
                                <td class="text-center vert-align">5/2016</td>
                                <td class="text-center vert-align">99.99 ron</td>
                                <td class="text-center vert-align">10 ron</td>
                                <td class="text-center vert-align">Nu</th>
                                <td class="text-center vert-align">
                                    <div class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Accesează factura</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END Table -->
                </div>

                <!-- BEGIN Pagination -->
                <div class="col-md-6">
                    <div class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
                </div>
                <div class="col-md-6">
                    <div class="btn btn-primary pull-left">Pagina urmatoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></div>
                </div>
                <!-- END Pagination -->

            </div>
        </div>

    </div>

</template>

<script>

export default {
    //
}

</script>
