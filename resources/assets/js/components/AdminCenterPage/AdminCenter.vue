<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">Centrul de administrare</div>

        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': usersIsActive }" href="/admin-center/users" class="list-group-item">Utilizatori</a>
            <a @click="componentClicked" :class="{ 'active': announcementsIsActive }" href="/admin-center/announcements" class="list-group-item">Anunțuri</a>
            <a @click="componentClicked" :class="{ 'active': applicationSettingsIsActive }" href="/admin-center/application-settings" class="list-group-item">Setări aplicație</a>
        </div>

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

        usersIsActive: function() {
            if (this.active == 'users') {
                return true;
            }

            return false;
        },

        announcementsIsActive: function() {
            if (this.active == 'announcements') {
                return true;
            }

            return false;
        },

        applicationSettingsIsActive: function() {
            if (this.active == 'application_settings') {
                return true;
            }

            return false;
        }

    }

}
</script>
