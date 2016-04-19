<template>
    <button @click="toggleSearchBar" class="btn btn-default">
    <i class="glyphicon glyphicon-search"></i>
</button>
</template>

<script>
export default {

    methods: {
        toggleSearchBar: function() {
            this.$dispatch('toggle_search_bar');
        }
    }

}
</script>