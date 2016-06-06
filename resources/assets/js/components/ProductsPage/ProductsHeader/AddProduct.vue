<template>

    <!-- BEGIN Add product -->
    <div class="col-md-4">
        <div @click="showModal" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ modal.openButtonText }}</div>
    </div>
    <!-- END Add product -->

    <!-- BEGIN Modal -->
    <div id="add-product-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="hideModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                  <div class="row">
                      <div class="col-md-10 col-md-offset-1">

                          <alert-danger :message="hasError"></alert-danger>
                          <!-- <div v-show="hasError" class="alert alert-danger">{{ error }}</div> -->

                          <!-- BEGIN Product code -->
                          <div :class="{ 'has-error': productCodeHasError }" class="form-group">
                              <label>Codul produsului</label>
                              <input v-model="productCode" @keyup.enter="addProduct" type="text" class="form-control" />
                              <span v-show="productCodeHasError" class="text-danger">{{ productCodeHasError }}</span>
                          </div>
                          <!-- END Product code -->

                          <!-- BEGIN Product name -->
                          <div :class="{ 'has-error': productNameHasError }" class="form-group">
                              <label>Numele produsului</label>
                              <input v-model="productName" @keyup.enter="addProduct" type="text" class="form-control" />
                              <span v-show="productNameHasError" class="text-danger">{{ productNameHasError }}</span>
                          </div>
                          <!-- END Product name -->

                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <div class="modal-footer">
                <button @click="hideModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                <button @click="addProduct" type="button" class="btn btn-primary">{{ modal.submitButton }}</button>
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

import AlertDanger from '../../../components/Alerts/AlertDanger.vue';

export default {

    data: function() {
        return {
            productCode: '',
            productName: '',
            loading: false,
            errors: '',
            error: '',
            modal: {
                selector: '#add-product-modal',
                title: 'Adaugă produs',
                submitButton: 'Adaugă produs',
                cancelButton: 'Anulează',
                openButtonText: 'Adaugă produs',
            },
        }
    },

    components: {
        'alert-danger': AlertDanger,
    },

    methods: {

        /**
         * Show the modal.
         */
        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        /**
         * Hide the modal.
         */
        hideModal: function() {
            if (this.loading) {
                return false;
            }

            $(this.modal.selector).modal('hide');
            this.emptyErrors();
            this.emptyInputs();
        },

        addProduct: function() {

            this.loading = true;
            var vn = this;

            var product = {
                _token: $('#token').attr('content'),
                product_name: this.productName,
                product_code: this.productCode
            };

            this.$http.post('/dashboard/products/add', product).then(function (success) {

                vn.loading = false;
                vn.hideModal();
                vn.$dispatch('reload_products', success.data.title, success.data.message);

            }, function (error) {

                vn.loading = false;

                if (error.data.message) {
                    vn.error = error.data.message;
                    vn.errors = '';
                    return;
                }

                if (error.data.errors) {
                    vn.errors = error.data.errors;
                    vn.error = '';
                    return;
                }

                vn.error = 'O eroare a avut loc. Redeschideti aplicatia pentru a incerca din nou.';
                vn.errors = '';
            });

        },

        /**
         * Empty all modal errors.
         */
        emptyErrors: function() {
            this.error = this.errors = '';
        },

        /**
         * Delete all introduced inputs.
         */
        emptyInputs: function() {
            this.productCode = this.productName = '';
        },

    },

    computed: {

        /**
         * Check if general error exists.
         */
        hasError: function() {
            if (this.error && !this.loading) {
                return this.error;
            }

            return false;
        },

        /**
         * Check if product_code input contain error message.
         */
        productCodeHasError: function() {
            if (this.errors.product_code && !this.loading) {
                return this.errors.product_code;
            }

            return false;
        },

        /**
         * Check if product_name input contain error message.
         */
        productNameHasError: function() {
            if (this.errors.product_name && !this.loading) {
                return this.errors.product_name;
            }

            return false;
        }

    }

}

</script>
