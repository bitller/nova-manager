<template>

    <div v-show="message" class="col-md-12">
        <div class="alert alert-warning">{{ message }}</div>
    </div>

</template>

<script>

export default {

    props: ['message'],

}

</script>
