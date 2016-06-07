<template>

    <div class="col-md-3">

        <div class="dropdown text-right">
            <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">{{ orderedByText }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li @click="changeOrderBy('created_at')"><a href="#">Ordonează după data adăugării</a></li>
                <li @click="changeOrderBy('code')"><a href="#">Ordonează după cod</a></li>
            </ul>
        </div>

    </div>

</template>

<script>

export default {

    props: ['orderedBy'],

    data: function() {
        return {

        }
    },

    ready: function() {
        $('.order-by').selectpicker();
    },

    methods: {
        changeOrderBy: function(column) {

            var vm = this;

            if (column !== 'created_at' && column !== 'code') {
                return;
            }

            var data = {
                _token: $('#token').attr('content'),
                order_by: column,
            };

            this.$http.post('/dashboard/products/update-order-by', data).then(function (success) {

                vm.$dispatch('reload_products');
                vm.$dispatch('changeOrderBy', column);

            }, function (error) {
                //
            });

        },
    },

    computed: {

        orderedByText: function() {
            if (this.orderedBy == 'code') {
                return 'Ordonează după cod';
            }
            return 'Ordonează după data adăugării';
        },

    }

}

</script>
