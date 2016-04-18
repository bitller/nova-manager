<template>

    <div class="add-bill-button">
        <bills-title></bills-title>
        <search-button></search-button>
        <create-bill></create-bill>
        <search-bar></search-bar>
    </div>

</template>

<script>

import BillsTitle from '../../components/BillsPage/TopSection/BillsTitle.vue';
import SearchButton from '../../components/BillsPage/TopSection/SearchButton.vue';
import CreateBill from '../../components/BillsPage/TopSection/CreateBill.vue';
import SearchBar from '../../components/BillsPage/TopSection/SearchBar.vue';

export default {

    components: {
        'bills-title': BillsTitle,
        'search-button': SearchButton,
        'create-bill': CreateBill,
        'search-bar': SearchBar
    },

    events: {
        'toggle_search_bar': function () {
            this.$broadcast('toggle_search_bar')
        }
    }

}
</script>