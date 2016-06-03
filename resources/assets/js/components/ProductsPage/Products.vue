<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Produse</span>
            </div>
        </div>

        <div class="col-md-12 white">

            <div class="row">
                <div class="col-md-12">
                    <search></search>
                    <order-by></order-by>
                    <order-type></order-type>
                    <displayed></displayed>
                </div>
            </div>

            <product name="test" code="bau" id="4"></product>
            <product name="test" code="bau" id="4"></product>
            <product name="test" code="bau" id="4"></product>

            <div class="col-md-12">
                <span class="grey">Este afișată pagina 1 din 2</span>
            </div>

            <!-- BEGIN Pagination -->
            <div class="col-md-6">
                <div class="btn btn-info pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
            </div>

            <div class="col-md-6">
                <div class="btn btn-info pull-left">Pagina următoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></div>
            </div>
            <!-- END Pagination -->

        </div>

    </div>

</template>

<script>

import Search from '../../components/ProductsPage/Products/Search.vue';
import OrderBy from '../../components/ProductsPage/Products/OrderBy.vue';
import OrderType from '../../components/ProductsPage/Products/OrderType.vue';
import Displayed from '../../components/ProductsPage/Products/Displayed.vue';
import Product from '../../components/ProductsPage/Products/Product.vue';

export default {

    components: {
        'search': Search,
        'order-by': OrderBy,
        'order-type': OrderType,
        'displayed': Displayed,
        'product': Product,
    },

}

</script>
