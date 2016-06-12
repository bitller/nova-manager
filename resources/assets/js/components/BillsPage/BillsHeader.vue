<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Page title and description -->
            <div class="col-md-4">
                <span class="page-title dark-grey">Facturi</span>
                <span class="page-description grey">1024 (de) facturi</span>
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

    components: {
        'order-by': OrderBy,
        'create-bill': CreateBill,
    },

}

</script>
