<template>
    <div v-if="showSearchBar" transition="search-bar" class="form-group search-bar" style="margin-top: 15px;">
        <input type="text" class="form-control" placeholder="Cauta dupa numele clientului" />
    </div>
</template>
        
<script>
    export default {
        
        data: function() {
            return {
                showSearchBar: false
            }
        },

        events: {
            'toggle_search_bar': function() {
                this.showSearchBar = !this.showSearchBar;
            }
        }
        
    }
</script>