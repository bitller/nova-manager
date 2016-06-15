<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Page title and description -->
            <div class="col-md-4">
                <span class="page-title dark-grey">Facturi</span>
                <span class="page-description grey">{{ numberOfBillsText }}</span>
            </div>
            <!-- END Page title and description -->

            <create-bill></create-bill>

        </div>
    </div>

</template>

<script>

import OrderBy from '../../components/BillsPage/BillsHeader/OrderBy.vue';
import CreateBill from '../../components/BillsPage/BillsHeader/CreateBill.vue';

export default {

    data: function() {
        return {
            bills: 0
        }
    },

    components: {
        'order-by': OrderBy,
        'create-bill': CreateBill,
    },

    events: {
        'numberOfBillsUpdated': function(numberOfBills) {
            this.bills = numberOfBills;
        }
    },

    computed: {
        numberOfBillsText: function() {
            var lastTwo = this.bills % 100;
            if (this.bills < 20 || lastTwo < 20) {
                return this.bills + ' facturi';
            }

            return this.bills + ' de facturi';
        }
    }

}

</script>
