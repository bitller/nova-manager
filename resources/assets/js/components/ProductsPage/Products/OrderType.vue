<template>

    <div class="col-md-3">

        <div class="dropdown">
            <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">{{ orderTypeText }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li @click="changeOrderType('asc')"><a href="#">În ordine crescătoare</a></li>
                <li @click="changeOrderType('desc')"><a href="#">În ordine descrescătoare</a></li>
            </ul>
        </div>

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

    methods: {

        changeOrderType: function(type) {

            var vm = this;

            if (type !== 'asc' && type !== 'desc') {
                return;
            }

            var data = {
                _token: $('#token').attr('content'),
                order_type: type
            };

            this.$http.post('/dashboard/products/update-order-type', data).then(function (success) {

                vm.$dispatch('reload_products');
                vm.$dispatch('changeOrderType', type);

            }, function (error) {
                //
            });
        },

    },

    computed: {

        orderTypeText: function() {
            if (this.orderType == 'asc') {
                return 'În ordine crescătoare';
            }

            return 'În ordine descrescătoare';
        }

    },
}

</script>
