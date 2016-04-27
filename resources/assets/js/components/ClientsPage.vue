er<template>

    <!-- BEGIN Title -->
    <div v-if="!loading" class="col-md-12">
        <h4>Clienții mei <span class="badge">{{ searchResults.total }}</span></h4>
    </div>
    <!-- END Title -->

    <!-- BEGIN Loader -->
    <div v-if="loading" class="col-md-12 text-center">
        <img src="/img/loading-bubbles-big.svg" />
    </div>
    <!-- END Loader -->

    <search-client v-if="!loading"></search-client>
    <add-client v-if="!loading"></add-client>

    <clients-table v-if="!loading" :results="searchResults"></clients-table>

</template>

<script>

import SearchClient from '../components/ClientsPage/SearchClient.vue';
import AddClient from '../components/ClientsPage/AddClient.vue';
import ClientsTable from '../components/ClientsPage/ClientsTable.vue';

export default {

    data: function() {
        return {
            loading: false,
            searchResults: '',
        }
    },

    ready: function() {
        this.getClients();
    },

    components: {
        'search-client': SearchClient,
        'add-client': AddClient,
        'clients-table': ClientsTable,
    },

    methods: {

        getClients: function(url, callback) {

            this.loading = true;
            var vn = this;

            if (typeof url === 'undefined') {
                url = '/dashboard/clients/get';
            }

            this.$http.get(url).then(function (success) {

                vn.loading = false;
                vn.searchResults = success.data;
                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });

        },

    },

    events: {

        'previous_page': function() {
            if (!this.loading) {
                this.getClients(this.search_results.next_page_url);
            }
        },

        'next_page_url': function() {
            if (!this.loading) {
                this.getClients(this.search_results.prev_page_url);
            }
        },

        'clients_updated': function(title, message) {
            var vn = this;
            this.getClients(undefined, function() {
                vn.$dispatch('success_alert', title, message);
            });
        }
    }

}

</script>
