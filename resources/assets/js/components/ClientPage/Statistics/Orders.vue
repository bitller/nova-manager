<template>

    <stats-panel title="Comenzi efectuate" :content="orders"></stats-panel>

</template>

<script>

import StatsPanel from '../../../components/ClientPage/Statistics/StatsPanel.vue';

export default {

    props: ['orders'],

    components: {
        'stats-panel': StatsPanel,
    }

}

</script>
