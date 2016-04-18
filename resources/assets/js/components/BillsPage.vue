<template>

<div id="bills">
    <div id="table">
    <top-section></top-section>
    <bills-table></bills-table>
    </div>
    </div>

    </template>

    <script>

import BillsTable from '../components/BillsPage/BillsTable.vue';
import TopSection from '../components/BillsPage/TopSection.vue';

export default {

    components: {
        'bills-table': BillsTable,
        'top-section': TopSection
    }

}
</script>