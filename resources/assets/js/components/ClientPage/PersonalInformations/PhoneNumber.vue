<template>

    <div class="col-md-4">
        <div>
            <span class="glyphicon glyphicon-phone grey-dark"></span>&nbsp;
            <span class="client-info-title grey-dark">Numărul de telefon</span>
        </div>
        <div>
            <span class="client-info grey">{{ phoneNumber }}</span>
        </div>
    </div>

</template>

<script>

export default {

    props: ['phoneNumber'],

}

</script>
