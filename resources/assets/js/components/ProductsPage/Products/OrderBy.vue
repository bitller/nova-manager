<template>

    <div class="col-md-3">
        <select class="order-by pull-right" style="display:none">
            <option v-if="orderedByName" value="name" selected>Ordoneaza dupa nume</option>
            <option v-if="orderedByCode" value="code" selected>Ordoneaza dupa cod</option>
            <option v-if="!orderedByName" value="name">Ordoneaza dupa nume</option>
            <option v-if="orderedByCode" value="code">Ordoneaza dupa cod</option>
        </select>
    </div>

</template>

<script>

export default {

    props: ['orderedBy'],

    ready: function() {
        $('.order-by').selectpicker();
    },

    computed: {

        orderedByName: function() {
            if (this.orderedBy == 'name') {
                return 'true';
            }

            return 'false';
        }
    }

}

</script>
