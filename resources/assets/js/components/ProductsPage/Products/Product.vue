<template>

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ showProductName(name) }}
            </div>
            <div class="panel-body">
                <div class="row text-center"><span class="product-code grey">{{ code }}</span></div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    props: ['name', 'code', 'id'],

    methods: {

        showProductName: function (name) {
            if (name.length > 39) {
                return name.substring(0, 38) + '...';
            }

            return name;
        }

    },

}

</script>
