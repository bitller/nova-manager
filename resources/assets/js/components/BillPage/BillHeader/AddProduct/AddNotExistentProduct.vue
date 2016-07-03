<template>

    <!-- BEGIN Modal -->
    <div id="add-not-existent-product-modal" data-backdrop="static" class="modal fade" role="dialog">
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

                          <div class="alert alert-info">Introduceți un nume pentru produsul asociat codului <strong>{{ productCode }}</strong>. După aceea o să puteți folosi acest produs în viitoarele facturi.</div>

                          <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                          <!-- BEGIN Product name -->
                          <div class="row">
                              <div class="col-md-12">
                                  <div :class="{ 'has-error': productNameHasError }" class="form-group">
                                      <label>Numele produsului</label>
                                      <input @keyup.enter="addNotExistentProduct" v-model="productName" type="text" class="form-control" />
                                      <span v-show="productNameHasError" class="text-danger">{{ productNameHasError }}</span>
                                  </div>
                              </div>
                          </div>
                          <!-- END Product name -->

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button @click="closeModal" :class="{ 'disabled': loading }" type="button" class="btn btn-default">Anulează</button>
                <button @click="addNotExistentProduct" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                    <span v-show="!loading">Salvează produsul</span>
                    <img v-show="loading" src="/img/loading-bubbles.svg" />
                </button>
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    props: ['billId'],

    data: function() {
        return {
            loading: false,
            productName: '',
            productCode: '',
            form: '',
            modal: {
                selector: '#add-not-existent-product-modal',
                title: 'Acest produs nu exista',
            },
            errors: {
                productCode: '',
                productName: '',
            },
        }
    },

    methods: {

        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        closeModal: function() {
            if (this.loading) {
                return false;
            }
            $(this.modal.selector).modal('hide');
            this.emptyInputs();
            this.emptyErrors();
        },

        addNotExistentProduct: function() {

            this.loading = true;
            var vm = this;
            this.form._token = $('#token').attr('content');
            this.form.product_name = this.productName;

            this.$http.post('/dashboard/bills/' + this.billId + '/add-not-existent-product', this.form).then(function (success) {

                vm.$dispatch('reloadProducts', function() {
                    vm.loading = false;
                    vm.closeModal();
                    vm.$dispatch('closeAddProductModal');
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                })

            }, function (error) {

                vm.loading = false;
                vm.emptyErrors();

                if (!vm.loading && typeof error.data.errors !== 'undefined') {
                    vm.errors.productName = error.data.errors.product_name;
                    return;
                }

                vm.closeModal();
                vm.$dispatch('closeAddProductModal');
                vm.$dispatch('error_alert', 'Ooops.', 'O eroare a avut loc.');

            });

        },

        emptyInputs: function() {
            this.productName = this.productCode = '';
        },

        emptyErrors: function() {
            this.errors.productName = this.errors.productCode = '';
        },

    },

    events: {
        'showAddNotExistentProductModal': function(form) {
            this.showModal();
            this.form = form;
        },
    },

    computed: {

        productNameHasError: function() {
            if (!this.loading && this.errors.productName) {
                return this.errors.productName;
            }
            return false;
        }

    },

    watch: {
        'form': function() {
            this.productCode = this.form.product_code;
        }
    }

}

</script>
