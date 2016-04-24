<template>

    <registered-users :registered-users="registeredUsers"></registered-users>
    <users-with-paid-subscription :users-with-paid-subscription="usersWithPaidSubscriptions"></users-with-paid-subscription>
    <users-on-trial :users-on-trial="usersInTrial"></users-on-trial>
    <not-confirmed-users :not-confirmed-users="notConfirmedUsers"></not-confirmed-users>

</template>

<script>

import RegisteredUsers from '../../../components/AdminCenterPage/Metrics/Users/RegisteredUsers.vue';
import UsersWithPaidSubscription from '../../../components/AdminCenterPage/Metrics/Users/UsersWithPaidSubscription.vue';
import UsersOnTrial from '../../../components/AdminCenterPage/Metrics/Users/UsersOnTrial.vue';
import NotConfirmedUsers from '../../../components/AdminCenterPage/Metrics/Users/NotConfirmedUsers.vue';

export default {

    components: {
        'registered-users': RegisteredUsers,
        'users-with-paid-subscription': UsersWithPaidSubscription,
        'users-on-trial': UsersOnTrial,
        'not-confirmed-users': NotConfirmedUsers
    },

    ready: function() {
        this.getMetrics();
    },

    data: function() {
        return {
            registeredUsers: 0,
            usersWithPaidSubscriptions: 0,
            usersInTrial: 0,
            notConfirmedUsers: 0
        }
    },

    methods: {

        getMetrics: function() {

            this.registeredUsers = 204;
            this.usersWithPaidSubscriptions = 184;
            this.usersInTrial = 14;
            this.notConfirmedUsers = 6;

        }

    }

}

</script>
