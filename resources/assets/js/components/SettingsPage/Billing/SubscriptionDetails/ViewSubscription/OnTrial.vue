<template>

    <div class="well">Abonamentul tău este in perioada gratuită de {{ trialDays }} zile. După aceea prețul abonamentului o să fie de 19.99 ron/lună, având posibilitatea de a renunța oricând doriți, fără nicio obligație.</div>

    <div class="btn btn-success" data-toggle="modal" data-target="#create-subscription"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;Creează abonamentul plătit de acum</div>

</template>

<script>

export default {

    props: ['trialDays'],

}

</script>
