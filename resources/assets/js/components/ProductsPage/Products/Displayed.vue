<template>

    <div class="col-md-3">

        <div class="dropdown">
            <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">{{ displayedText }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li @click="changeDisplayed(12)"><a href="#">Afişează 12 produse</a></li>
                <li @click="changeDisplayed(24)"><a href="#">Afişează 24 produse</a></li>
                <li @click="changeDisplayed(36)"><a href="#">Afişează 36 produse</a></li>
            </ul>
        </div>
    </div>

</template>

<script>

export default {

    props: ['display'],

    methods: {

        changeDisplayed(number) {
            var vm = this;

            if (number !== 12 && number !== 24 && number !== 36) {
                return;
            }

            var data = {
                _token: $('#token').attr('content'),
                products_displayed: number
            };

            this.$http.post('/dashboard/products/update-products-displayed', data).then(function (success) {

                vm.$dispatch('reload_products');
                vm.$dispatch('changeDisplayed', number);

            }, function (error) {
                //
            });
        }

    },

    computed: {

        displayedText: function() {
            return 'Afişează ' + this.display + ' produse';
        }

    }

}

</script>
