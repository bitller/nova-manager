<template>

    <!-- BEGIN Modal -->
    <div id="set-payment-term-modal" data-backdrop="static" class="modal fade" role="dialog">
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

                          <!-- BEGIN Payment term -->
                          <div :class="{ 'has-error': paymentTermHasError }" class="form-group">
                              <label>Termenul de plată al acestei facturi</label>
                              <input @keyup.enter="setPaymentTerm" v-model="paymentTerm" type="text" class="form-control payment-term" />
                              <span v-show="paymentTermHasError" class="text-danger">{{ paymentTermHasError }}</span>
                          </div>
                          <!-- END Payment term -->

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button @click="hideModal" type="button" :class="{ 'disabled': loading }" class="btn btn-default">Anulează</button>
                <button @click="setPaymentTerm" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                    <span v-show="!loading">Savlează</span>
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

    props: ['currentPaymentTerm', 'billId'],

    data: function() {
        return {
            loading: false,
            paymentTerm: '',
            modal: {
                selector: '#set-payment-term-modal',
                title: 'Setează termenul de plată al acestei facturi'
            },
            error: '',
            paymentTermError: '',
        }
    },

    ready: function() {
        $('.payment-term').datepicker({
            format: 'dd-mm-yyyy'
        });
    },

    methods: {

        setPaymentTerm: function() {

            if (this.loading) {
                return false;
            }

            this.loading = true;
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                payment_term: this.paymentTerm
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/set-payment-term', data).then(function (success) {

                vm.loading = false;
                vm.$dispatch('reloadPaymentTerm', function() {
                    vm.hideModal();
                    vm.$dispatch('success_alert', success.data.title, success.data.message)
                });

            }, function (error) {

                vm.loading = false;
                vm.error = vm.paymentTermError = '';

                if (typeof error.data.errors !== 'undefined' && error.data.errors.payment_term) {
                    vm.paymentTermError = error.data.errors.payment_term;
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
            this.error = this.paymentTermError = this.paymentTerm = '';
        },

    },

    watch: {
        'currentPaymentTerm': function(currentPaymentTerm) {
            this.paymentTerm = currentPaymentTerm;
        },
    },

    computed: {

        hasError: function() {
            if (!this.loading && this.error) {
                return this.error;
            }
            return false;
        },

        paymentTermHasError: function() {
            if (!this.loading && this.paymentTermError) {
                return this.paymentTermError;
            }
            return false;
        },

    }

}

</script>
