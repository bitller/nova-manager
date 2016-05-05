<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Page title and description -->
            <div class="col-md-2">
                <span class="page-title grey-dark">Clienţi</span>
                <span class="page-description grey">1002 (de) clienţi</span>
            </div>
            <!-- END Page title and description -->

            <search-client></search-client>
            <order-by></order-by>
            <add-client></add-client>

        </div>
    </div>

</template>

<script>

import SearchClient from '../../components/ClientsPage/ClientsHeader/SearchClient.vue';
import OrderBy from '../../components/ClientsPage/ClientsHeader/OrderBy.vue';
import AddClient from '../../components/ClientsPage/ClientsHeader/AddClient.vue';

export default {

    components: {
        'search-client': SearchClient,
        'order-by': OrderBy,
        'add-client': AddClient,
    },

}

</script>
