<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Products text -->
            <div class="col-md-8">
                <span class="page-title grey-dark">Produse</span>
                <span class="page-description grey">
                    <span v-show="!searched && numberOfProducts != 1" class="page-description grey">Aveţi {{ numberOfProducts }} {{ bound }} produse</span>
                    <span v-show="!searched && numberOfProducts == 1" class="page-description grey">Aveţi {{ numberOfProducts }} produs</span>
                    <span v-show="searched && numberOfProducts != 1" class="page-description grey">{{ numberOfProducts }} {{ bound }} produse găsite</span>
                    <span v-show="searched && numberOfProducts == 1" class="page-description grey">{{ numberOfProducts }} produs găsit</span>
                </span>
            </div>
            <!-- END Products text -->

            <!-- BEGIN Add product -->
            <div class="col-md-4">
                <div class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Adauga produs</div>
            </div>
            <!-- END Add product -->

        </div>
    </div>

</template>

<script>

export default {

    props: ['numberOfProducts', 'searched'],

    data: function() {
        return {
            bound: '',
        }
    },

    computed: {

        bound: function() {
            if (this.numberOfProducts < 19) {
                return '';
            }

            var lastTwo = this.numberOfProducts % 100;
            if (lastTwo > 19) {
                return 'de';
            }
        },

    },

}

</script>
