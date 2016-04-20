<template>

    <!-- BEGIN Error -->
    <div v-if="error" class="col-md-6 col-md-offset-3">
        <div class="alert alert-danger">{{ error }}</div>
    </div>
    <!-- END Error -->

</template>

<script>
export default {

    props: ['error']

}
</script>
