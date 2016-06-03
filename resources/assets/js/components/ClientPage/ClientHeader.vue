<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Client name and join date -->
            <div class="col-sm-3 col-md-10">
                <span class="client-name grey-dark">{{ name }}</span>
                <span class="client-since grey">Client din {{ clientSince }}</span>
            </div>
            <!-- END Client name and join date -->

            <client-settings></client-settings>

        </div>
    </div>

</template>

<script>

import ClientSettings from '../../components/ClientPage/ClientHeader/ClientSettings.vue';

export default {

    components: {
        'client-settings': ClientSettings,
    },

    data: function() {
        return {
            clientId: $('#client').attr('content'),
            name: '',
            clientSince: '',
        }
    },

    ready: function() {
        this.getBasicClientInformations();
    },

    methods: {

        getBasicClientInformations: function() {

            var vn = this;
            this.$http.get('/dashboard/clients/' + this.clientId + '/basic-informations').then(function (success) {

                vn.clientSince = success.data.created_at;
                vn.name = success.data.name;

            }, function (error) {
                //
            });

        },

    },

}

</script>
