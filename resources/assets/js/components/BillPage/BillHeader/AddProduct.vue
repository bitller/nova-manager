<template>
    <!-- <div style="display: inline-block"> -->
        <div @click="showModal" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Adaugă produs</div>

        <!-- BEGIN Modal -->
        <div id="add-product-modal" data-backdrop="static" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                  </div>
                  <div class="modal-body">

                      <div class="row">
                          <div class="col-md-12">

                              <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                              <div class="row">
                                  <!-- BEGIN Product code -->
                                  <div class="col-md-12">
                                      <div :class="{ 'has-error': productCodeHasError }" class="form-group">
                                          <label>Codul produsului <span class="badge" data-toggle="tooltip" data-placement="right" :title="tooltips.productCode">?</span></label>
                                          <input @keyup.enter="addProduct" v-model="product.code" type="text" class="form-control" />
                                          <span v-show="productCodeHasError" class="text-danger">{{ productCodeHasError }}</span>
                                      </div>
                                  </div>
                                  <!-- END Product code -->
                              </div>

                              <div class="row">
                                  <!-- BEGIN Product price -->
                                  <div class="col-md-6">
                                      <div :class="{ 'has-error': productPriceHasError }" class="form-group">
                                          <label>Pretul produsului <span class="badge" data-toggle="tooltip" :title="tooltips.productPrice">?</span></label>
                                          <input @keyup.enter="addProduct" v-model="product.price" type="text" class="form-control" />
                                          <span v-show="productPriceHasError" class="text-danger">{{ productPriceHasError }}</span>
                                      </div>
                                  </div>
                                  <!-- END Product price -->

                                  <!-- Product discount -->
                                  <div class="col-md-6">
                                      <div :class="{ 'has-error': productDiscountHasError }" class="form-group">
                                          <label>Reducerea aplicata <span class="badge" data-toggle="tooltip" :title="tooltips.productDiscount">?</span></label>
                                          <input @keyup.enter="addProduct" v-model="product.discount" type="text" class="form-control" />
                                          <span v-show='productDiscountHasError' class="text-danger">{{ productDiscountHasError }}</span>
                                      </div>
                                  </div>
                                  <!-- END Product discount -->
                              </div>

                              <div class="row">
                                  <!-- BEGIN Product page -->
                                  <div class="col-md-6">
                                      <div :class="{ 'has-error': productPageHasError }" class="form-group">
                                          <label>Pagina produsului <span class="badge" data-toggle="tooltip" :title="tooltips.productPage">?</span></label>
                                          <input @keyup.enter="addProduct" v-model="product.page" type="text" class="form-control" />
                                          <span v-show="productPageHasError" class="text-danger">{{ productPageHasError }}</span>
                                      </div>
                                  </div>
                                  <!-- END Product page -->

                                  <!-- BEGIN Product quantity -->
                                  <div class="col-md-6">
                                      <div :class="{ 'has-error': productQuantityHasError }" class="form-group">
                                          <label>Cantitatea produsului <span class="badge" data-toggle="tooltip" :title="tooltips.productQuantity">?</span></label>
                                          <input @keyup.enter="addProduct" v-model="product.quantity" type="text" class="form-control" />
                                          <span v-show="productQuantityHasError" class="text-danger">{{ productQuantityHasError }}</span>
                                      </div>
                                  </div>
                                  <!-- END Product page -->
                              </div>

                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="checkbox">
                                          <label><input type="checkbox" v-model="product.notAvailable">Acest produs nu este disponibil acum si va fi livarat data viitoare <span class="badge" data-toggle="tooltip" :title="tooltips.available">?</span></label>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button @click="closeModal" :class="{ 'disabled': loading }" type="button" class="btn btn-default">Anulează</button>
                    <button @click="addProduct" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                        <span v-show="!loading">Adaugă produs</span>
                        <img v-show="loading" src="/img/loading-bubbles.svg" />
                    </button>
                  </div>
            </div>

            </div>

        </div>
        <!-- END Modal -->
        <add-not-existent-product :bill-id="billId"></add-not-existent-product>
    <!-- </div> -->
</template>

<script>

import AddNotExistentProduct from '../../../components/BillPage/BillHeader/AddProduct/AddNotExistentProduct.vue';

export default {

    components: {
        'add-not-existent-product': AddNotExistentProduct,
    },

    props: ['billId'],

    data: function() {
        return {
            loading: false,
            product: {
                code: '',
                price: '',
                discount: '',
                page: '',
                quantity: '',
                notAvailable: false,
            },
            modal: {
                selector: '#add-product-modal',
                title: 'Adaugă produs'
            },
            errors: {
                productCode: '',
                productPrice: ''
            },
            tooltips: {
                productCode: 'Codul din 5 cifre al produsului.',
                productPrice: 'Prețul care va fi aplicat acestui produs. Între 0 și 9999 ron.',
                productDiscount: 'Reducerea care să fie aplicată acestui produs, în procente (de exemplu 50). Lăsați câmpul necompletat în cazul în care nu oferiți reducere pentru acest produs.',
                productPage: 'Numărul paginii din catalog în care apare produsul. Puteți lăsa acest câmp necompletat.',
                productQuantity: 'Canitatea produsului. Lăsând acest câmp necompletat, se va folosi valoarea 1 (însemnând un singur produs).',
                available: 'Dacă acest produs nu poate fi livrat acum, bifați această căsuță, iar acest lucru va fi evidențiat pe factură.',
            },
            productCodeNotExists: 'validation.product_code_belongs_to_current_user',
        }
    },

    methods: {

        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        hideModal: function() {
            if (this.loading) {
                return false;
            }
            $(this.modal.selector).modal('hide');
        },

        closeModal: function() {
            if (this.loading) {
                return false;
            }
            this.hideModal();
            this.emptyErrors();
            this.emptyInputs();
        },

        addProduct: function() {

            if (this.loading) {
                return false;
            }

            this.loading = true;

            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                product_code: this.product.code,
                product_page: this.product.page,
                product_price: this.product.price,
                product_discount: this.product.discount,
                product_quantity: this.product.quantity,
                available_now: !this.product.notAvailable,
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/add-product', data).then(function (success) {

                vm.$dispatch('reloadProducts', function() {
                    vm.loading = false;
                    vm.closeModal();
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                vm.loading = false;
                vm.emptyErrors();

                if (error.data.errors.product_code) {
                    vm.errors.code = error.data.errors.product_code;
                }
                if (error.data.errors.product_page) {
                    vm.errors.page = error.data.errors.product_page;
                }
                if (error.data.errors.product_price) {
                    vm.errors.price = error.data.errors.product_price;
                }
                if (error.data.errors.product_discount) {
                    vm.errors.discount = error.data.errors.product_discount;
                }
                if (error.data.errors.product_quantity) {
                    vm.errors.quantity = error.data.errors.product_quantity;
                }

                if (error.data.errors.product_code === this.productCodeNotExists && !this.atLeastOneInputHasErrorExceptProductCode) {
                    // This product does not exists, ask user if want to add
                    vm.productDoesNotExists(data);
                    return;
                }

                if (vm.atLeastOneInputHasError) {
                    return;
                }

                vm.closeModal();
                vm.$dispatch('error_alert', 'Eroare.', 'O eroare a avut loc.');
            });
        },

        productDoesNotExists: function(form) {

            var vm = this;
            var config = {
                type: 'info',
                title: 'Produsul nu exista.',
                message: 'Acest produs nu exista. Doriti sa il adaugati acum? Dupa ce l-ati adaugat, o sa il puteti folosi la fel ca celelate.',
                confirmButtonColor: '#60C5BA',
            };

            vm.hideModal();

            this.$dispatch('confirmation', config, function() {
                vm.$dispatch('close_opened_alert');
                // vm.hideModal();
                vm.$broadcast('showAddNotExistentProductModal', form);
            }, function() {
                vm.showModal();
            });

        },

        emptyErrors: function() {
            this.errors = {
                price: '',
                discount: '',
                code: '',
                page: '',
                quantity: ''
            }
        },

        emptyInputs: function() {
            this.product.price = this.product.discount = this.product.code = this.product.page = this.product.quantity = '';
        }

    },

    computed: {
        productPriceHasError: function() {
            if (!this.loading && this.errors.price) {
                return this.errors.price;
            }
            return false;
        },

        productDiscountHasError: function() {
            if (!this.loading && this.errors.discount) {
                return this.errors.discount;
            }
            return false;
        },

        productCodeHasError: function() {
            if (!this.loading && this.errors.code && this.errors.code !== this.productCodeNotExists) {
                return this.errors.code;
            }
            return false;
        },

        productPageHasError: function() {
            if (!this.loading && this.errors.page) {
                return this.errors.page;
            }
            return false;
        },

        productQuantityHasError: function() {
            if (!this.loading && this.errors.quantity) {
                return this.errors.quantity;
            }
        },

        atLeastOneInputHasError: function() {
            if (this.productPriceHasError || this.productDiscountHasError || this.productCodeHasError || this.productPageHasError || this.productQuantityHasError) {
                return true;
            }
            return false;
        },

        atLeastOneInputHasErrorExceptProductCode: function() {
            if (this.productPriceHasError || this.productDiscountHasError || this.productPageHasError || this.productQuantityHasError) {
                return true;
            }
            return false;
        }

    },

    events: {

        'closeAddProductModal': function() {
            this.closeModal();
        },

        'hideAddProductModal': function() {
            this.hideModal();
        },

    }

}

</script>
