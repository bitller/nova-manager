<style>

.options-menu {
    display: inline-block;
}

</style>

<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Bill owner and bill campaign -->
            <div class="col-md-9">
                <span class="page-title grey-dark">John Doe&nbsp;<span v-show="billIsMarkedAsPaid" class="glyphicon glyphicon-ok" data-toggle="tooltip" title="Această factură a fost plătită." data-placement="right"></span></span>
                <span class="page-description grey">Comanda 1 din campania <a href="#">4/2016</a>
            </div>
            <!-- END Bill owner and bill campaign -->

            <!-- BEGIN Buttons -->
            <div class="col-md-3">
                <div class="btn btn-info"><span class="glyphicon glyphicon-print"></span></div>
                <div class="dropdown options-menu">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-cog"></span>
                    </button>
                        <ul class="dropdown-menu">
                            <li v-show="billIsMarkedAsUnpaid" @click="markBillAsPaid"><a href="#"><span class="glyphicon glyphicon-ok"></span>&nbsp;Marchează factura ca plătită</a></li>
                            <li v-show="billIsMarkedAsPaid" @click="markBillAsUnpaid"><a href="#"><span class="glyphicon glyphicon-ok"></span>&nbsp;Marchează factura ca neplătită</a></li>
                            <li @click="setPaymentTermModal"><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Setează termenul de plată</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Editează detaliile suplimentare</a></li>
                            <li class="divider"></li>
                            <li @click="deleteBill"><a href="#"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge factura</a></li>
                        </ul>
                </div>
                <div class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Adaugă produs</div>
            </div>
            <!-- END Buttons -->

            <div class="col-md-12 alerts">

                <!-- BEGIN Payment term not set alert -->
                <div class="alert alert-warning">
                    Seteaza termenul de plata pentru aceasta factura.
                </div>
                <!-- END Payment term not set alert -->

                <!-- BEGIN Payment term expired -->
                <div class="alert alert-danger">
                    Aceasta factura trebuia platita pana in data de 9.03.2016.
                </div>
                <!-- END Payment term expired -->

            </div>

        </div>

        <set-payment-term-modal :current-payment-term="paymentTerm" :bill-id="billId"></set-payment-term-modal>

    </div>

</template>

<script>

import SetPaymentTermModal from '../../components/BillPage/BillHeader/SetPaymentTermModal.vue';

export default {

    components: {
        'set-payment-term-modal': SetPaymentTermModal,
    },

    props: ['billId', 'status', 'paymentTerm'],

    data: function() {
        return {
            billStatus: '',
        }
    },

    methods: {

        deleteBill: function() {

            var config = {
                message: 'Această factură va fi ștearsă definitiv.',
                confirmButtonText: 'Șterge factura'
            };

            var vm = this;

            // Ask for confirmation
            this.$dispatch('confirmation', config, function() {

                // Do delete request only if user confirmed
                vm.$http.post('/dashboard/bills/' + vm.billId + '/delete', { _token: $('#token').attr('content') }).then(function(success) {

                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                    window.location.replace('/dashboard');

                }, function(error) {

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
            });
        },

        markBillAsPaid: function() {
            this.changeBillStatus('paid');
        },

        markBillAsUnpaid: function() {
            this.changeBillStatus('unpaid');
        },

        changeBillStatus: function(status) {

            // Assign default value
            if (status !== 'paid' && status !== 'unpaid') {
                status = 'paid';
            }

            var url = '/dashboard/bills/' + this.billId + '/mark-as-' + status;
            var vm = this;

            this.$http.get(url).then(function (success) {

                vm.$dispatch('reloadProducts', function() {
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                var title = 'Ooops.';
                var message = 'O eraore a avut loc.';

                if (error.data.title) {
                    title = error.data.title;
                }
                if (error.data.message) {
                    message = error.data.message;
                }

                vm.$dispatch('error_alert', title, message);
            });
        },

        setPaymentTermModal: function() {
            $('#set-payment-term-modal').modal('show');
        },
    },

    computed: {
        billIsMarkedAsPaid: function() {
            if (this.status === 'paid') {
                return true;
            }
            return false;
        },

        billIsMarkedAsUnpaid: function() {
            if (this.status === 'unpaid') {
                return true;
            }
            return false;
        },
    },

}

</script>
