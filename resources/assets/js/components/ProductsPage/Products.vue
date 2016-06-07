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
                    <order-by :ordered-by="sortDetails.order_by"></order-by>
                    <order-type :order-type="sortDetails.order_type"></order-type>
                    <displayed :display="sortDetails.products_displayed"></displayed>
                </div>
            </div>

            <div class="col-md-12">
                <div v-show="showNoSearchResults" class="alert alert-warning">
                    Cautarea <strong>{{ searched }}</strong> nu a returnat niciun rezultat. Incearcati cu alt nume sau alt cod.
                </div>
            </div>

            <product v-for="product in products.data" :name="product.name" :code="product.code" :id="product.id"></product>

            <div v-show="showCurrentPageText" class="col-md-12">
                <span class="grey">Este afișată pagina {{ products.current_page }} din {{ products.last_page }}</span>
            </div>

            <!-- BEGIN Pagination -->
            <div v-show="showPagination">
                <div class="col-md-6">
                    <div @click="previousPage" class="btn btn-info pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
                </div>

                <div class="col-md-6">
                    <div @click="nextPage" class="btn btn-info pull-left">Pagina următoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></div>
                </div>
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

    data: function() {
        return {
            loadingProducts: false,
            products: '',
            searched: false,
            sortDetails: '',
        }
    },

    ready: function() {
        this.paginateProducts();
        this.getSortDetails();
    },

    components: {
        'search': Search,
        'order-by': OrderBy,
        'order-type': OrderType,
        'displayed': Displayed,
        'product': Product,
    },

    methods: {

        paginateProducts: function(url, callback) {

            this.loadingProducts = true;
            var vn = this;

            if (typeof url === 'undefined') {
                url = '/dashboard/products/paginate';
            }

            this.$http.get(url).then(function (success) {

                vn.loadingProducts = false;
                vn.products = success.data;
                vn.$dispatch('products_updated', success.data.total, vn.searched);

                // Check if a callback was given
                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });
        },

        previousPage: function() {
            if (!this.products.prev_page_url) {
                return false;
            }
            this.paginateProducts(this.products.prev_page_url);
        },

        nextPage: function() {
            if (!this.products.next_page_url) {
                return false;
            }
            this.paginateProducts(this.products.next_page_url);
        },

        getSortDetails: function() {

            var vm = this;

            this.$http.get('/dashboard/products/sort-details').then(function (success) {

                vm.sortDetails = success.data;

            }, function (error) {
                //
            });
        }

    },

    computed: {

        /**
         * Check if pagination buttons should be displayed or not.
         */
        showPagination: function() {
            if (this.products.next_page_url || this.products.prev_page_url) {
                return true;
            }

            return false;
        },

        /**
         * Check if "No search results" alert should be displayed.
         */
        showNoSearchResults: function() {
            if (this.products.total < 1 && this.searched) {
                return true;
            }

            return false;
        },

        /**
         * Check if page number info should be displayed.
         */
        showCurrentPageText: function() {
            if (this.products.current_page > this.products.last_page) {
                return false;
            }

            return true;
        },

    },

    events: {
        'search': function (term) {
            this.paginateProducts('/dashboard/products/paginate?search-term=' + term);
            this.searched = term;
        },

        'reload_products': function(title, message) {
            var vn = this;
            this.paginateProducts('/dashboard/products/paginate', function() {
                if (typeof title === 'undefined' || typeof message == 'undefined') {
                    return false;
                }
                vn.$dispatch('success_alert', title, message);
            });
        },

        'changeOrderType': function(type) {
            this.sortDetails.order_type = type;
            this.$broadcast('resetSearch');
        },

        'changeOrderBy': function(orderColumn) {
            this.sortDetails.order_by = orderColumn;
            this.$broadcast('resetSearch');
        },

        'changeDisplayed': function(number) {
            this.sortDetails.products_displayed = number;
            this.$broadcast('resetSearch');
        }
    }

}

</script>
