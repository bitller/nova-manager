<template>

    <div class="col-md-5">
        <div class="form-group has-feedback">
            <input v-model="searchTerm" type="text" class="form-control" placeholder="Caută după nume, email sau număr de telefon" />
            <i class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
    </div>

</template>

<script>

export default {

    data: function() {
        return {
            searchTerm: '',
        }
    },

    watch: {
        'searchTerm': function(value, oldValue) {

            if (value.length >= 3) {
                this.$dispatch('search', value);
                return;
            }

            this.$dispatch('search', '');
        },
    }

}

</script>
