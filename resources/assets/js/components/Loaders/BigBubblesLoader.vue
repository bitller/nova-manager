<template>

    <div v-show="loading" class="col-md-12 text-center">
        <img src="/img/loading-bubbles-big.svg" />
    </div>

</template>

<script>

export default {

    props: ['loading']

}

</script>
