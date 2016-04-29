<template>

    <!-- BEGIN Search client -->
    <div class="col-md-7">
        <div class="form-group has-feedback">
            <input v-model="searchTerm" type="text" class="form-control" placeholder="Căutaţi după numele, email-ul sau numărul de telefon al clientului" />
            <i class="glyphicon glyphicon-search form-control-feedback grey"></i>
        </div>
    </div>
    <!-- END Search client -->

</template>

<script>

export default {

    data: function() {
        return {
            searchTerm: ''
        }
    },

    watch: {
        'searchTerm': function(value, oldValue) {

            if (value.length < 1) {
                this.$dispatch('search', '');
            }

            if (value.length < 3) {
                return;
            }

            this.$dispatch('search', value);
        }
    }

}

</script>
