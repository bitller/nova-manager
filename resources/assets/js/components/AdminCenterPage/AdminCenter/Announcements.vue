<template>

    <create-new-announcement></create-new-announcement>
    <recent-announcements></recent-announcements>

</template>

<script>

import CreateNewAnnouncement from '../../../components/AdminCenterPage/AdminCenter/Announcements/CreateNewAnnouncement.vue';
import RecentAnnouncements from '../../../components/AdminCenterPage/AdminCenter/Announcements/RecentAnnouncements.vue';

export default {

    components: {
        'create-new-announcement': CreateNewAnnouncement,
        'recent-announcements': RecentAnnouncements
    }

}

</script>
