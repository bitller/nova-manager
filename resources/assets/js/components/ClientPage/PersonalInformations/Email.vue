<template>

    <div class="col-md-4">
        <div>
            <span class="glyphicon glyphicon-envelope grey-dark"></span>&nbsp;
            <span class="client-info-title grey-dark">Adresă de email</span>
        </div>
        <div>
            <span class="client-info grey">{{ email }}</span>
        </div>
    </div>

</template>

<script>

export default {

    props: ['email'],

}

</script>
