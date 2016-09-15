<style>
.inline-div {
    display: inline-block;
}
</style>
<template>

    <div class="col-md-12">

        <div class="col-md-12 primary hidden-print">
            <div class="col-md-12">
                <span class="primary-title">Informatii despre factura</span>
            </div>
        </div>

        <div class="col-md-12 white last">

            <more-details :bill-id="billId" :current-details="otherDetails"></more-details>

            <!-- BEGIN Payment term -->
            <div class="col-md-4">
                <div class="panel panel-info hidden-print">
                    <div class="panel-heading">
                        Termenul de plată
                    </div>
                    <div class="panel-body">
                        <div class="row text-center"><span @click="setPaymentTermModal" class="grey-dark bill-detail pointer">{{ displayPaymentTerm(paymentTerm) }}</span></div>
                    </div>
                </div>
                <div class="col-md-4 text-center visible-print">
                    <h5><strong>Termenul de plată</strong></h5>
                    <h5>{{ displayPaymentTerm(paymentTerm) }}</h5>
                </div>
            </div>
            <!-- END Payment term -->

            <!-- BEGIN To pay -->
            <div class="col-md-4">
                <div class="panel panel-info hidden-print">
                    <div class="panel-heading">
                        Trebuie sa platiti
                    </div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="grey-dark bill-detail">{{ toPay }} ron</span></div>
                    </div>
                </div>
                <div class="col-md-4 text-center visible-print">
                    <h5><strong>Trebuie sa platiti</strong></h5>
                    <h5>{{ toPay }} ron</h5>
                </div>
            </div>
            <!-- END To pay -->

            <!-- BEGIN Saved money -->
            <div class="col-md-4">
                <div class="panel panel-info hidden-print">
                    <div class="panel-heading">
                        Ati economisit
                    </div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="grey-dark bill-detail">{{ savedMoney }} ron</span></div>
                    </div>
                </div>
                <div class="inline-div col-md-4 text-center visible-print">
                    <h5><strong>Ati economisit</strong></h5>
                    <h5>{{ savedMoney }} ron</h5>
                </div>
            </div>
            <!-- END Saved money -->

        </div>

    </div>

</template>

<script>

import MoreDetails from '../../components/BillPage/Informations/MoreDetails.vue';

export default {

    props: ['billId', 'toPay', 'paymentTerm', 'savedMoney', 'otherDetails'],

    components: {
        'more-details': MoreDetails,
    },

    methods: {
        displayPaymentTerm: function(paymentTerm) {
            if (paymentTerm === '0000-00-00' || !paymentTerm) {
                return 'Nu a fost setat';
            }

            return paymentTerm;
        },

        setPaymentTermModal: function() {
            $('#set-payment-term-modal').modal('show');
        },
    }

}

</script>
