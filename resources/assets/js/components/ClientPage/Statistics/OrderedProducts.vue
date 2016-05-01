<template>

    <stats-panel title="Produce comandate" :content="products"></stats-panel>

</template>

<script>

import StatsPanel from '../../../components/ClientPage/Statistics/StatsPanel.vue';

export default {

    props: ['products'],

    components: {
        'stats-panel': StatsPanel,
    }

}

</script>
