<template>

    <div class="col-md-12">

        <!-- BEGIN Products -->
        <div v-show="existsAvailableProducts" class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Produsele acestei facturi</span>
            </div>
        </div>

        <div v-show="existsAvailableProducts" class="col-md-12 white">
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
                            <tr v-for="product in products.available">
                                <td class="text-center vert-align">{{ showProductPage(product.pivot.page) }}</td>
                                <td class="text-center vert-align">{{ product.code }}</td>
                                <td class="text-center vert-align">{{ product.name }}</td>
                                <td class="text-center vert-align">{{ product.pivot.quantity }}</td>
                                <td class="text-center vert-align">{{ product.pivot.price }} ron</td>
                                <td class="text-center vert-align">{{ product.pivot.discount }}%</td>
                                <td class="text-center vert-align">{{ product.pivot.price_without_discount }} ron</td>
                                <td class="text-center vert-align">
                                    <div @click="deleteProductConfirmation(product.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Products -->

        <!-- BEGIN Not available products -->
        <div v-show="existsNotAvailableProducts" class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Produse indisponibile care o sa fie livrate data viitoare</span>
            </div>
        </div>

        <div v-show="existsNotAvailableProducts" class="col-md-12 white">

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
                            <tr v-for="product in products.notAvailable">
                                <td class="text-center vert-align">{{ showProductPage(product.pivot.page) }}</td>
                                <td class="text-center vert-align">{{ product.code }}</td>
                                <td class="text-center vert-align">{{ product.name }}</td>
                                <td class="text-center vert-align">{{ product.pivot.quantity }}</td>
                                <td class="text-center vert-align">{{ product.pivot.price }} ron</td>
                                <td class="text-center vert-align">{{ product.pivot.discount }}%</td>
                                <td class="text-center vert-align">{{ product.pivot.price_without_discount }} ron</td>
                                <td class="text-center vert-align">
                                    <div @click="deleteProductConfirmation(product.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
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

    props: ['products', 'billId'],

    methods: {

        deleteProductConfirmation: function(productId) {

            var vm = this;

            swal({
                title: 'Sunteți sigur?',
                text: ' Sigur doriți să ștergeți acest produs?',
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Anulează',
                cancelButtonColor: '#bdc3c7',
                confirmButtonColor: "#E05082",
                confirmButtonText: "Șterge produsul",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function() {
                vm.deleteProduct(productId);
            });

        },

        deleteProduct: function(productId) {

            var vm = this;
            var product = {
                _token: $('#token').attr('content'),
                product_id: productId
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/delete-product', product).then(function(success) {
                vm.$dispatch('reloadProducts', function() {
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });
            }, function (error) {

                var title = 'Ooops.';
                var message = 'O eroare a avut loc.';

                if (error.data.title) {
                    title = error.data.title;
                }
                if (error.data.message) {
                    message = error.data.message;
                }

                vm.$dispatch('error_alert', title, message);
            });

        },

        showProductPage: function(page) {
            if (page < 1) {
                return '-';
            }
            return page;
        }
    },

    computed: {

        existsAvailableProducts: function() {

            var count = 0;
            for (var product in this.products.available) {
                count++;
                break;
            }

            return count;
        },

        existsNotAvailableProducts: function() {

            var count = 0;
            for (var product in this.products.notAvailable) {
                count++;
                break;
            }

            return count;
        },
    }

}

</script>
