<template>

    <stats-panel title="Venituri aduse" :content="earnings"></stats-panel>

</template>

<script>

import StatsPanel from '../../../components/ClientPage/Statistics/StatsPanel.vue';

export default {

    props: ['earnings'],

    components: {
        'stats-panel': StatsPanel,
    }

}

</script>
