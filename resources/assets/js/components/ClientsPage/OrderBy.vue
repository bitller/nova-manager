<template>

    <!-- BEGIN Order by -->
    <div class="col-md-4">
        <div class="form-group">
            <select v-model="filter" class="form-control input input-default order-by" style="display:none">
                <option value="created_at_asc">Ordoneaza dupa cei mai vechi clienti</option>
                <option value="created_at_desc">Ordoneaza dupa cei mai noi clienti</option>
                <option value="alphabetic">Ordoneaza dupa nume in ordine alfabetica</option>
            </select>
        </div>
    </div>
    <!-- END Order by -->

</template>

<script>

export default {

    ready: function() {
        $('.order-by').selectpicker({
            'style': 'form-control'
        });
    },

    data: function() {
        return {
            filter: ''
        }
    },

    watch: {
        'filter': function(value, oldValue) {
            console.log(this.filter);
        }
    }

}

</script>
