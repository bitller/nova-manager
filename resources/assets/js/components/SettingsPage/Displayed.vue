<template>

    <div class="panel panel-default">
        <div class="panel-heading">Afisare</div>
        <div class="list-group">
             <a @click="componentClicked" :class="{ 'active': billsIsActive }" href="/dashboard/settings/bills" class="list-group-item">Numarul de facturi afisate</a>
             <a @click="componentClicked" :class="{ 'active': clientsIsActive}" href="/dashboard/settings/clients" class="list-group-item">Numarul de clienti afisati</a>
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
        billsIsActive: function() {
            if (this.active === 'bills') {
                return true;
            }

            return false;
        },

        clientsIsActive: function() {
            if (this.active === 'clients') {
                return true;
            }

            return false;
        }
    }

}
</script>
