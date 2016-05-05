<template>

    <div class="col-md-12">

        <!-- BEIGN Bills -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Facturi</span>
            </div>
        </div>

        <div class="col-md-12 white last">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Client</th>
                                <th class="text-center">Produse</th>
                                <th class="text-center">Preț</th>
                                <th class="text-center">Comanda</th>
                                <th class="text-center">Campania</th>
                                <th class="text-center">Preț</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="1 in 10">
                                <td class="text-center vert-align"><img src="http://lorempixel.com/40/40" class="client-picture" /><span class="client-name-in-table">John Doe</span></td>
                                <td class="text-center vert-align">21313</td>
                                <td class="text-center vert-align">john@example.com</td>
                                <td class="text-center vert-align">john@example.com</td>
                                <td class="text-center vert-align">john@example.com</td>
                                <td class="text-center vert-align">john@example.com</td>
                                <td class="text-center vert-align">
                                    <div class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <span class="grey">Este afișată pagina 1 din 4</span>
            </div>

            <!-- BEGIN Pagination -->
            <div class="col-md-6">
                <div class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
            </div>
            <div class="col-md-6">
                <div class="btn btn-primary pull-left">Pagina urmatoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>
            </div>
            <!-- END Pagination -->

        </div>
        <!-- END Bills -->

    </div>

</template>

<script>

export default {
    //
}

</script>
