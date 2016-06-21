<template>

    <!-- BEGIN Modal -->
    <div id="edit-product-discount-modal" data-backdrop="static" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button @click="hideModal" type="button" class="close">&times;</button>
                <h4 class="modal-title">{{ modal.title }}</h4>
              </div>
              <div class="modal-body">

                  <div class="row">
                      <div class="col-md-10 col-md-offset-1">

                          <div v-show="hasError" class="alert alert-danger">{{ hasError }}</div>

                          <!-- BEGIN Product page -->
                          <div :class="{ 'has-error': discountHasError }" class="form-group">
                              <label>Reducerea aplicată produsului</label>
                              <input @keyup.enter="editDiscount" v-model="discount" type="text" class="form-control" />
                              <span v-show="discountHasError" class="text-danger">{{ discountHasError }}</span>
                          </div>
                          <!-- END Product page -->

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button @click="hideModal" type="button" :class="{ 'disabled': loading }" class="btn btn-default">Anulează</button>
                <button @click="editDiscount" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                    <span v-show="!loading">Editează reducerea</span>
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

    props: ['product', 'billId'],

    data: function() {
        return {
            loading: false,
            discount: '',
            modal: {
                selector: '#edit-product-discount-modal',
                title: 'Editează reducerea aplicată produsului'
            },
            error: '',
            priceError: '',
        }
    },

    methods: {

        editDiscount: function() {

            if (this.loading) {
                return false;
            }

            this.loading = true;
            var vm = this;
            var product = {
                _token: $('#token').attr('content'),
                product_discount: this.discount
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/products/' + this.product.bill_product_id + '/edit-discount', product).then(function (success) {

                vm.loading = false;
                vm.$dispatch('reloadProducts', function() {
                    vm.hideModal();
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                vm.loading = false;
                vm.error = vm.discountError = '';

                if (error.data.errors.product_discount) {
                    vm.discountError = error.data.errors.product_discount;
                    return;
                }
                if (error.data.message) {
                    vm.error = error.data.message;
                    return;
                }

                vm.error = 'O eroare a avut loc.';
            });

        },

        hideModal: function() {
            if (this.loading) {
                return false;
            }
            $(this.modal.selector).modal('hide');
            this.error = this.discountError = this.discount = '';
        },

    },

    watch: {
        'product': function(product) {
            this.discount = product.pivot.discount;
        }
    },

    computed: {

        hasError: function() {
            if (!this.loading && this.error) {
                return this.error;
            }
            return false;
        },

        discountHasError: function() {
            if (!this.loading && this.discountError) {
                return this.discountError;
            }
            return false;
        },

    }

}

</script>
