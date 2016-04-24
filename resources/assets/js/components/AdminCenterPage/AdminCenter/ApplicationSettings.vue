<template>

    <logo-text></logo-text>
    <allow-new-users></allow-new-users>

</template>

<script>

import LogoText from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/LogoText.vue';
import AllowNewUsers from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/AllowNewUsers.vue';

export default {

    components: {
        'logo-text': LogoText,
        'allow-new-users': AllowNewUsers,
    }

}

</script>
