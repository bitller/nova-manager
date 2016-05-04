<template>

    <div class="col-md-12">

        <!-- BEGIN Products -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Produsele acestei facturi</span>
            </div>
        </div>

        <div class="col-md-12 white">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Pagină</th>
                                <th class="text-center">Cod</th>
                                <th class="text-center">Nume</th>
                                <th class="text-center">Cantitate</th>
                                <th class="text-center">Preț</th>
                                <th class="text-center">Reducere</th>
                                <th class="text-center">Preț final</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="1 in 10">
                                <td class="text-center vert-align">4</td>
                                <td class="text-center vert-align">21313</td>
                                <td class="text-center vert-align">john@example.com</td>
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
        </div>
        <!-- END Products -->

        <!-- BEGIN Not available products -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Produse indisponibile care o sa fie livrate data viitoare</span>
            </div>
        </div>

        <div class="col-md-12 white">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Pagină</th>
                                <th class="text-center">Cod</th>
                                <th class="text-center">Nume</th>
                                <th class="text-center">Cantitate</th>
                                <th class="text-center">Preț</th>
                                <th class="text-center">Reducere</th>
                                <th class="text-center">Preț final</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="1 in 2">
                                <td class="text-center vert-align">4</td>
                                <td class="text-center vert-align">21313</td>
                                <td class="text-center vert-align">john@example.com</td>
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

        </div>
        <!-- END Not available products -->

    </div>

</template>

<script>

export default {
    //
}

</script>
