<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Facturare</div>

        <!-- BEGIN List group -->
        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': subscriptionDetailsIsActive }" href="/dashboard/settings/subscription-details" class="list-group-item">Abonament activ</a>
            <a @click="componentClicked" :class="{ 'active': paymentsIsActive }" href="/dashboard/settings/payments" class="list-group-item">Plăți</a>
            <a @click="componentClicked" :class="{ 'active': creditCardIsActive }" href="/dashboard/settings/credit-card" class="list-group-item">Card de credit</a>
        </div>
        <!-- END List group -->

    </div>
    <!-- END Panel -->

</template>

<script>
export default {

    props: ['active'],

    methods: {

        componentClicked: function() {
            this.$dispatch('component_clicked');
        }

    },

    computed: {

        subscriptionDetailsIsActive: function() {
            if (this.active == 'subscription_details') {
                return true;
            }

            return false;
        },

        paymentsIsActive: function() {
            if (this.active == 'payments') {
                return true;
            }

            return false;
        },

        creditCardIsActive: function() {
            if (this.active == 'credit_card') {
                return true;
            }

            return false;
        }

    }

}
</script>
