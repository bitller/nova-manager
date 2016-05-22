<template>

    <div class="page-container">

        <div class="row">
            <clients-header :number-of-clients="numberOfClients" :searched="searched"></clients-header>
            <clients :clients="searchResults"></clients>
        </div>

    </div>

</template>

<script>

import ClientsHeader from '../components/ClientsPage/ClientsHeader.vue';
import Clients from '../components/ClientsPage/Clients.vue';

export default {

    data: function() {
        return {
            numberOfClients: 0,
            searched: false,
        }
    },

    components: {
        'clients-header': ClientsHeader,
        'clients': Clients,
    },

    events: {
        'search': function(term) {
            this.$broadcast('search', term);
        },

        'clients_updated': function(total, searched) {
            this.numberOfClients = total;
            this.searched = searched;
        },
    },

    // data: function() {
    //     return {
    //         loading: false,
    //         searchResults: '',
    //     }
    // },
    //
    // ready: function() {
    //     // this.getClients();
    // },
    //
    // components: {
    //     'clients-header': ClientsHeader,
    //     'clients': Clients,
    // },
    //
    // methods: {
    //
    //     getClients: function(url, callback, search = false) {
    //
    //         if (!search) {
    //             this.loading = true;
    //         } else {
    //             this.loadingSearchResults = true;
    //         }
    //
    //         var vn = this;
    //
    //         if (typeof url === 'undefined') {
    //             url = '/dashboard/clients/get';
    //         }
    //
    //         this.$http.get(url).then(function (success) {
    //
    //             if (!search) {
    //                 vn.loading = false;
    //             } else {
    //                 vn.loadingSearchResults = false;
    //             }
    //
    //             vn.searchResults = success.data;
    //             if (typeof callback !== 'undefined') {
    //                 callback();
    //             }
    //
    //         }, function (error) {
    //
    //             if (!search) {
    //                 vn.loading = false;
    //             } else {
    //                 vn.loadingSearchResults = false;
    //             }
    //
    //         });
    //
    //     },
    //
    // },
    //
    // events: {
    //
    //     'previous_page': function() {
    //         if (!this.loading && !this.loadingSearchResults && this.searchResults.prev_page_url) {
    //             this.getClients(this.searchResults.prev_page_url, undefined, true);
    //         }
    //     },
    //
    //     'next_page': function() {
    //         if (!this.loading && !this.loadingSearchResults && this.searchResults.next_page_url) {
    //             this.getClients(this.searchResults.next_page_url, undefined, true);
    //         }
    //     },
    //
    //     'clients_updated': function(title, message) {
    //         var vn = this;
    //         this.getClients(undefined, function() {
    //             vn.$dispatch('success_alert', title, message);
    //         });
    //     },
    //
    //     'search': function(term) {
    //         this.getClients('/dashboard/clients/get?search-query=' + term, undefined, true);
    //     }
    // }

}

</script>
