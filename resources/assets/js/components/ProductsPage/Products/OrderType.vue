<template>

    <div class="col-md-3">
        <select v-model="selectedOrderType" class="order-by pull-right" style="display:none">
            <option :selected="orderTypeIsAscendent" value="asc">Crescator</option>
            <option :selected="!orderTypeIsAscendent" value="desc">Descrescator</option>
        </select>
    </div>

</template>

<script>

export default {

    props: ['orderType'],

    data: function() {
        return {
            selectedOrderType: ''
        }
    },

    ready: function() {
        $('.order-by').selectpicker();
    },

    computed: {

        orderTypeIsAscendent: function() {
            if (this.orderType == 'asc') {
                return 'true';
            }

            return 'false';
        },

    },
}

</script>
