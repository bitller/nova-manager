<template>

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ name }}
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

}

</script>
