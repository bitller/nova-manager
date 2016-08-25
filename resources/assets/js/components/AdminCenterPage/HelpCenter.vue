<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Centrul de ajutor</div>
        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': ticketsIsActive }" href="/admin-center/tickets" class="list-group-item">Tichete</a>
            <a @click="componentClicked" :class="{ 'active': frequentQuestionsIsActive}" href="/admin-center/frequent-questions" class="list-group-item">Intrebari frecvente</a>
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
        ticketsIsActive: function() {
            if (this.active == 'tickets') {
                return true;
            }
            return false;
        },

        frequentQuestionsIsActive: function() {
            if (this.active == 'frequent_questions') {
                return true;
            }
            return false;
        }
    }

}

</script>
