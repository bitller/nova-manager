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

        'reload_clients': function(title, message) {
            this.$broadcast('reload_clients', title, message);
        },
    },

}

</script>
