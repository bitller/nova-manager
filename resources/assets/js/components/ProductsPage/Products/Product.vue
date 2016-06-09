<template>

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ showProductName(name) }}
            </div>
            <div class="panel-body">
                <div class="row text-center"><span @click="showModal" class="product-code grey">{{ code }}</span></div>
            </div>
        </div>
    </div>

    <edit-product-modal></edit-product-modal>

</template>

<script>

import EditProductModal from '../../../components/ProductsPage/Products/Product/EditProductModal.vue';

export default {

    props: ['name', 'code', 'id'],

    components: {
        'edit-product-modal': EditProductModal
    },

    methods: {

        showProductName: function (name) {
            if (name.length > 39) {
                return name.substring(0, 38) + '...';
            }

            return name;
        },

        showModal: function() {
            console.log('modal call');
            var product = {
                id: this.id,
                name: this.name,
                code: this.code
            };

            this.$broadcast('showEditProductModal', product);
        }

    },

}

</script>
