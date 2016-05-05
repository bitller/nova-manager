<template>

    <div class="page-container">

        <div class="row">
            <bills-header></bills-header>
            <bills></bills>
        </div>

    </div>

</template>

<script>

import BillsHeader from '../components/BillsPage/BillsHeader.vue';
import Bills from '../components/BillsPage/Bills.vue';

export default {

    components: {
        'bills-header': BillsHeader,
        'bills': Bills,
    },

}
</script>
