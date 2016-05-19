<template>

    <div class="panel panel-info">
        <div class="panel-heading">Setari</div>
        <div class="list-group">
             <a @click="componentClicked" :class="{ 'active': profileIsActive }" href="/dashboard/settings/profile" class="list-group-item">Profile</a>
             <a @click="componentClicked" :class="{ 'active': securityIsActive }" href="/dashboard/settings/security" class="list-group-item">Securitate</a>
             <a @click="componentClicked" :class="{ 'active': displayedIsActive}" href="/dashboard/settings/displayed" class="list-group-item">Afisare</a>
        </div>
    </div>

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
        profileIsActive: function() {
            if (this.active === 'profile') {
                return true;
            }

            return false;
        },

        securityIsActive: function() {
            if (this.active === 'security') {
                return true;
            }

            return false;
        },

        displayedIsActive: function() {
            if (this.active === 'displayed') {
                return true;
            }

            return false;
        }
    }

}
</script>
