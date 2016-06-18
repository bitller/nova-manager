<template>

    <!-- BEGIN Modal -->
    <div id="edit-product-page-modal" data-backdrop="static" class="modal fade" role="dialog">
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
                          <div :class="{ 'has-error': pageHasError }" class="form-group">
                              <label>Pagina produsului</label>
                              <input @keyup.enter="editPage" v-model="page" type="text" class="form-control" />
                              <span v-show="pageHasError" class="text-danger">{{ pageHasError }}</span>
                          </div>
                          <!-- END Product page -->

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button @click="hideModal" type="button" :class="{ 'disabled': loading }" class="btn btn-default">Anulează</button>
                <button @click="editPage" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                    <span v-show="!loading">Editează pagina</span>
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
            page: '',
            modal: {
                selector: '#edit-product-page-modal',
                title: 'Editeaza pagina produsului',
            },
            error: '',
            pageError: '',
        }
    },
    
    methods: {

        editPage: function() {

            if (this.loading) {
                return false;
            }

            this.loading = true;
            var vm = this;
            var product = {
                _token: $('#token').attr('content'),
                product_page: this.page
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/products/' + this.product.bill_product_id + '/edit-page', product).then(function (success) {

                vm.loading = false;
                vm.$dispatch('reloadProducts', function() {
                    vm.hideModal();
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                vm.loading = false;
                vm.error = vm.pageError = '';

                if (error.data.errors.product_page) {
                    vm.pageError = error.data.errors.product_page;
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
            this.error = this.pageError = this.page = '';
        },

    },

    watch: {
        'product': function(product) {
            this.page = product.pivot.page;
        }
    },

    computed: {

        hasError: function() {
            if (!this.loading && this.error) {
                return this.error;
            }
            return false;
        },

        pageHasError: function() {
            if (!this.loading && this.pageError) {
                return this.pageError;
            }
            return false;
        },
    }

}
</script>
