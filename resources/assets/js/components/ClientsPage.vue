<template>

    <!-- BEGIN Title -->
    <div class="col-md-12">
        <h4>Clienții mei <span class="badge">{{ searchResults.total }}</span></h4>
    </div>
    <!-- END Title -->

    <search-client></search-client>
    <add-client></add-client>

    <clients-table :results="searchResults"></clients-table>

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

        getClients: function(url) {

            this.loading = true;
            var vn = this;

            if (typeof url === 'undefined') {
                url = '/dashboard/clients/get';
            }

            this.$http.get(url).then(function (success) {

                vn.loading = false;
                vn.searchResults = success.data;

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
        }
    }

}

</script>
