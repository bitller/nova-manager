<template>

    <!-- BEGIN Modal -->
    <div id="edit-product-modal" class="modal fade" data-backdrop="static" role="dialog">
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

                          <!-- BEGIN Product code -->
                          <div :class="{ 'has-error': productCodeHasError }" class="form-group">
                              <label>Codul produsului</label>
                              <input v-model="productCode" @keyup.enter="edit" type="text" class="form-control" />
                              <span v-show="productCodeHasError" class="text-danger">{{ productCodeHasError }}</span>
                          </div>
                          <!-- END Product code -->

                          <!-- BEGIN Product name -->
                          <div :class="{ 'has-error': productNameHasError }" class="form-group">
                              <label>Numele produsului</label>
                              <input v-model="productName" @keyup.enter="edit" type="text" class="form-control" />
                              <span v-show="productNameHasError" class="text-danger">{{ productNameHasError }}</span>
                          </div>
                          <!-- END Product name -->

                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <!-- BEGIN Modal footer -->
              <div class="modal-footer">
                  <button @click="hideModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                  <button @click="edit" type="button" class="btn btn-primary">
                      <span v-show="!loading">{{ modal.submitButton }}</span>
                      <img v-show="loading" src="/img/loading-bubbles.svg" />
                  </button>
              </div>
              <!-- END Modal footer -->

          </div>
        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

import AlertDanger from '../../../../components/Alerts/AlertDanger.vue';

export default {

    components: {
        'alert-danger': AlertDanger,
    },

    data: function() {
        return {
            productId: '',
            productName: '',
            productCode: '',
            loading: false,
            modal: {
                selector: '#edit-product-modal',
                title: 'Editează acest produs',
                cancelButton: 'Anulează',
                submitButton: 'Salvează modificările',
            },
            error: '',
            errors: {
                productName: '',
                productCode: ''
            }
        }
    },

    methods: {

        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        hideModal: function() {
            $(this.modal.selector).modal('hide');
            this.emptyErrors();
            this.emptyInputs();
        },

        edit: function() {

            if (this.loading) {
                return;
            }

            this.loading = true;
            var vm = this;

            var product = {
                _token: $('#token').attr('content'),
                product_id: this.productId,
                product_name: this.productName,
                product_code: this.productCode,
            };

            this.$http.post('/dashboard/products/edit/' + this.product.id).then(function (success) {
                //
            }, function (error) {
                //
            });

        },

        emptyErrors: function() {
            this.errors.productName = this.errors.productCode = '';
            this.error = '';
        },

        emptyInputs: function() {
            this.productCode = this.productName = '';
        }

    },

    computed: {

        productNameHasError: function() {
            if (!this.loading && this.errors.productName) {
                return this.errors.productName;
            }

            return false;
        },

        productCodeHasError: function() {
            if (!this.loading && this.errors.productCode) {
                return this.errors.productCode;
            }

            return false;
        },

        hasError: function() {
            if (!this.loading && this.error) {
                return this.error;
            }

            return false;
        }

    },

    events: {
        'showEditProductModal': function(product) {
            console.log('modal listener');
            this.showModal();
            this.productId = product.id;
            this.productName = product.name;
            this.productCode = product.code;
        }
    }

}

</script>
