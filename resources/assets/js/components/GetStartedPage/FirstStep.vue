<template>

    <div class="well custom-well">
        <div class="row">
            <div class="col-md-2">
                <img src="/img/baloons.svg" />
            </div>
            <div class="col-md-10">
                <h3 class="grey-dark">Bun venit!</h3>
                <h5 class="grey-middle">
                    <p>Hai sa vedem impreuna cat de usor este sa folosesti aplicatia Nova Manager pentru a-ti simplifica activitatea de reprezentant Avon. Pentru a incepe, apasa butonul de mai jos.</p>
                    <p>Tine minte, primele 90 de zile sun gratuite, timp in care poti renunta oricand, fara a platii nimic. Dupa aceea aplicatia va costa 19.99 ron/luna.</p>
                </h5>
                <div @click="moveToSecondStep" class="btn btn-success">Sa incepem</div>
                <h6 class="grey-middle underline pointer">Nu doresc sa vad cum se foloseste Nova Manager</h6>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    methods: {
        moveToSecondStep: function() {
            this.$dispatch('makeSecondStepActive');
        }
    }

}

</script>
