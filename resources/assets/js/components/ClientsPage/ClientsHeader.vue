<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Page title and description -->
            <div class="col-md-2">
                <span class="page-title grey-dark">Clienţi</span>
                <span v-show="!searched && numberOfClients != 1" class="page-description grey">Aveţi {{ numberOfClients }} {{ bound }} clienţi</span>
                <span v-show="!searched && numberOfClients == 1" class="page-description grey">Aveţi {{ numberOfClients }} client</span>
                <span v-show="searched && numberOfClients != 1" class="page-description grey">{{ numberOfClients }} {{ bound }} clienţi găsiți</span>
                <span v-show="searched && numberOfClients == 1" class="page-description grey">{{ numberOfClients }} client găsit</span>
            </div>
            <!-- END Page title and description -->

            <search-client></search-client>
            <!-- <displayed></displayed> -->
            <!-- <order-by></order-by> -->
            <add-client></add-client>

        </div>
    </div>

</template>

<script>

import SearchClient from '../../components/ClientsPage/ClientsHeader/SearchClient.vue';
import OrderBy from '../../components/ClientsPage/ClientsHeader/OrderBy.vue';
import AddClient from '../../components/ClientsPage/ClientsHeader/AddClient.vue';

export default {

    props: ['numberOfClients', 'searched'],

    data: function() {
        return {
            bound: '',
        }
    },

    components: {
        'search-client': SearchClient,
        'order-by': OrderBy,
        'add-client': AddClient,
    },

    computed: {

        bound: function() {
            if (this.numberOfClients < 19) {
                return '';
            }

            var lastTwo = this.numberOfClients % 100;
            if (lastTwo > 19) {
                return 'de';
            }
        },

    },

}

</script>
