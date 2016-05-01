<template>

    <div class="col-md-4">
        <div>
            <span class="glyphicon glyphicon-calendar grey-dark"></span>&nbsp;
            <span class="client-info-title grey-dark">Data nașterii</span>
        </div>
        <div>
            <span class="client-info grey">{{ date }}</span>
        </div>
    </div>

</template>

<script>

export default {

    props: ['date'],

}

</script>
