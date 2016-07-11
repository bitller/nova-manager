<style>

    .pointer {
        cursor: pointer;
    }

</style>
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
                                <th v-if="showDiscountColumn" class="text-center">Reducere</th>
                                <th v-if="showDiscountColumn" class="text-center">Preț cu reducere</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products.available">

                                <!-- BEGIN Product page -->
                                <td @click="editPageModal(product)" @mouseover="showEditIcon('page', 'f-'+$index)" @mouseleave="hideEditIcon('page', 'f-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('page', 'f-'+$index)">{{ showProductPage(product.pivot.page) }}</span>
                                    <span v-show="checkIcon('page', 'f-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product page -->

                                <td class="text-center vert-align">{{ product.code }}</td>
                                <td class="text-center vert-align">{{ product.name }}</td>

                                <!-- BEGIN Product quantity -->
                                <td @click="editQuantity(product)" @mouseover="showEditIcon('quantity', 'f-'+$index)" @mouseleave="hideEditIcon('quantity', 'f-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('quantity', 'f-'+$index)">{{ product.pivot.quantity }}</span>
                                    <span v-show="checkIcon('quantity', 'f-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product quantity -->

                                <!-- BEGIN Product price -->
                                <td @click="editPrice(product)" @mouseover="showEditIcon('price', 'f-'+$index)" @mouseleave="hideEditIcon('price', 'f-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('price', 'f-'+$index)">{{ product.pivot.price }} ron</span>
                                    <span v-show="checkIcon('price', 'f-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product price -->

                                <!-- BEGIN Product discount -->
                                <td v-if="showDiscountColumn" @click="editDiscount(product)" @mouseover="showEditIcon('discount', 'f-'+$index)" @mouseleave="hideEditIcon('discount', 'f-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('discount', 'f-'+$index)">{{ product.pivot.discount }}%</span>
                                    <span v-show="checkIcon('discount', 'f-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product discount -->

                                <td v-if="showDiscountColumn" class="text-center vert-align">{{ product.pivot.price_with_discount }} ron</td>
                                <td class="text-center vert-align">
                                    <div @click="deleteProductConfirmation(product.bill_product_id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
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
                                <th v-if="showDiscountColumn" class="text-center">Reducere</th>
                                <th v-if="showDiscountColumn" class="text-center">Preț cu reducere</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products.notAvailable">
                                <!-- BEGIN Product page -->
                                <td @click="editPageModal(product)" @mouseover="showEditIcon('page', 's-'+$index)" @mouseleave="hideEditIcon('page', 's-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('page', 's-'+$index)">{{ showProductPage(product.pivot.page) }}</span>
                                    <span v-show="checkIcon('page', 's-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product page -->

                                <td class="text-center vert-align">{{ product.code }}</td>
                                <td class="text-center vert-align">{{ product.name }}</td>

                                <!-- BEGIN Product quantity -->
                                <td @click="editQuantity(product)" @mouseover="showEditIcon('quantity', 's-'+$index)" @mouseleave="hideEditIcon('quantity', 's-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('quantity', 's-'+$index)">{{ product.pivot.quantity }}</span>
                                    <span v-show="checkIcon('quantity', 's-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product quantity -->

                                <!-- BEGIN Product price -->
                                <td @click="editPrice(product)" @mouseover="showEditIcon('price', 's-'+$index)" @mouseleave="hideEditIcon('price', 's-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('price', 's-'+$index)">{{ product.pivot.price }} ron</span>
                                    <span v-show="checkIcon('price', 's-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product price -->

                                <!-- BEGIN Product discount -->
                                <td v-if="showDiscountColumn" @click="editDiscount(product)" @mouseover="showEditIcon('discount', 's-'+$index)" @mouseleave="hideEditIcon('discount', 's-'+$index)" class="text-center vert-align pointer">
                                    <span v-show="!checkIcon('discount', 's-'+$index)">{{ product.pivot.discount }}%</span>
                                    <span v-show="checkIcon('discount', 's-'+$index)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <!-- END Product discount -->

                                <td v-if="showDiscountColumn" class="text-center vert-align">{{ product.pivot.price_with_discount }} ron</td>
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

        <edit-page-modal :product="modals.editPage.product" :bill-id="billId"></edit-page-modal>
        <edit-quantity-modal :product="modals.editQuantity.product" :bill-id="billId"></edit-quantity-modal>
        <edit-price-modal :product="modals.editPrice.product" :bill-id="billId"></edit-price-modal>
        <edit-discount-modal :product="modals.editDiscount.product" :bill-id="billId"></edit-discount-modal>

    </div>

</template>

<script>

import EditPageModal from '../../components/BillPage/Products/EditPageModal.vue';
import EditQuantityModal from '../../components/BillPage/Products/EditQuantityModal.vue';
import EditPriceModal from '../../components/BillPage/Products/EditPriceModal.vue';
import EditDiscountModal from '../../components/BillPage/Products/EditDiscountModal.vue';

export default {

    components: {
        'edit-page-modal': EditPageModal,
        'edit-quantity-modal': EditQuantityModal,
        'edit-price-modal': EditPriceModal,
        'edit-discount-modal': EditDiscountModal,
    },

    props: ['products', 'billId'],

    data: function() {
        return {
            editIcon: {
                page: {
                    index: ''
                },
                quantity: {
                    index: ''
                },
                price: {
                    index: ''
                },
                discount: {
                    index: ''
                },
            },
            modals: {
                editPage: {
                    selector: '#edit-product-page-modal',
                    product: '',
                },
                editQuantity: {
                    selector: '#edit-product-quantity-modal',
                    product: ''
                },
                editPrice: {
                    selector: '#edit-product-price-modal',
                    product: ''
                },
                editDiscount: {
                    selector: '#edit-product-discount-modal',
                    product: ''
                },
            }
        }
    },

    methods: {

        editPageModal: function(product) {
            this.modals.editPage.product = product;
            $(this.modals.editPage.selector).modal('show');
        },

        editQuantity: function(product) {
            this.modals.editQuantity.product = product;
            $(this.modals.editQuantity.selector).modal('show');
        },

        editPrice: function(product) {
            this.modals.editPrice.product = product;
            $(this.modals.editPrice.selector).modal('show');
        },

        editDiscount: function(product) {
            this.modals.editDiscount.product = product;
            $(this.modals.editDiscount.selector).modal('show');
        },

        deleteProductConfirmation: function(productId) {

            var config = {
                message: 'Sigur doriți să ștergeți produsul din factură?',
                confirmButtonText: 'Da, șterge produsul',
            };
            var vm = this;

            this.$dispatch('confirmation', config, function() {
                vm.deleteProduct(productId);
            });

        },

        deleteProduct: function(productId) {

            var vm = this;
            var product = {
                _token: $('#token').attr('content'),
                bill_product_id: productId
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

        showEditIcon: function(element, index) {
            if (element === 'page') {
                this.editIcon.page.index = index;
                return;
            }
            if (element === 'quantity') {
                this.editIcon.quantity.index = index;
                return;
            }
            if (element === 'price') {
                this.editIcon.price.index = index;
                return;
            }
            if (element === 'discount') {
                this.editIcon.discount.index = index;
                return;
            }
        },

        hideEditIcon: function(element) {
            if (element === 'page') {
                this.editIcon.page.index = '';
                return;
            }
            if (element === 'quantity') {
                this.editIcon.quantity.index = '';
                return;
            }
            if (element === 'price') {
                this.editIcon.price.index = '';
                return;
            }
            if (element === 'discount') {
                this.editIcon.discount.index = '';
                return;
            }
        },

        checkIcon: function(element, index) {
            if (element === 'page') {
                if (this.editIcon.page.index === index) {
                    return true;
                }
                return false;
            }
            if (element === 'quantity') {
                if (this.editIcon.quantity.index === index) {
                    return true;
                }
                return false;
            }
            if (element === 'price') {
                if (this.editIcon.price.index === index) {
                    return true;
                }
                return false;
            }
            if (element === 'discount') {
                if (this.editIcon.discount.index === index) {
                    return true;
                }
                return false;
            }
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

        showDiscountColumn: function() {

            if (typeof this.products.available !== 'undefined') {
                for (var product in this.products.available) {
                    if (this.products.available[product].pivot.discount > 0) {
                        return true;
                    }
                }
            }

            if (typeof this.products.notAvailable !== 'undefined') {
                for (var product in this.products.notAvailable) {
                    if (this.products.notAvailable[product].pivot.discount > 0) {
                        return true;
                    }
                }
            }

            return false;
        },

    }

}

</script>
