<template>

    <create-new-user v-if="!userSubsection"></create-new-user>
    <search-users v-if="!userSubsection"></search-users>
    <user v-if="userSubsection" :user-id="userId"></user>

</template>

<script>

import SearchUsers from '../../../components/AdminCenterPage/AdminCenter/Users/SearchUsers.vue';
import CreateNewUser from '../../../components/AdminCenterPage/AdminCenter/Users/CreateNewUser.vue';
import User from '../../../components/AdminCenterPage/AdminCenter/Users/User.vue';

export default {

    props: ['subSection', 'userId'],

    components: {
        'search-users': SearchUsers,
        'create-new-user': CreateNewUser,
        'user': User
    },

    computed: {

        userSubsection: function() {
            if (this.subSection == 'user_details') {
                return true;
            }

            return false;
        }
    }

}

</script>
