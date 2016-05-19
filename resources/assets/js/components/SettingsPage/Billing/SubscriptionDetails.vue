<template>

    <view-subscription></view-subscription>

</template>

<script>

import ViewSubscription from '../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription.vue';

export default {

    ready: function() {
        // this.getCurrentSubscription();
        // this.initBraintree();
    },

    components: {
        'view-subscription': ViewSubscription
    },

    methods: {

        getCurrentSubscription: function() {
            this.$http.get('/dashboard/settings/subscription-details/get-current-subscription').then(function (success) {
                console.log(success.data);
            }, function (error) {
                //
            });
        },

        initBraintree: function() {

            var vn = this;

            // Make request to get client token
            this.$http.get('/dashboard/settings/subscription-details/generate-client-token').then(function (success) {

                var client = new braintree.api.Client({
                    clientToken: success.data.client_token
                });

                client.tokenizeCard({
                    number: "4111111111111111",
                    expirationDate: "10/20",
                }, function (error, nonce) {
                    var data = {
                        _token: $('#token').attr('content'),
                        nonce: nonce,
                    };

                    // Send nonce to the server
                    vn.$http.post('/dashboard/settings/subscription-details/new', data).then(function (success) {
                        //
                    }, function (error) {
                        //
                    });
                });

            }, function (error) {
                //
            });

        },

    }

}

</script>
