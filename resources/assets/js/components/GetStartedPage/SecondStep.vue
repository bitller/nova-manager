<style>
.title {
    font-family: 'PT Sans', serif;
    font-size: 25px;
}
.description {
    font-family: 'PT Sans', serif;
    font-size: 17px;
    line-height: 1.7;
}
.create-my-first-bill-button {
    margin-top: 20px;
}
</style>
<template>
    <div class="well custom-well">
        <div class="row">
            <div class="col-md-3">
                <img src="/img/news.svg" />
            </div>
            <div class="col-md-9">
                <h4 class="grey-dark title">Ce este o factura?</h4>
                <h5 class="grey-middle description">
                    O factura reprezinta o comanda. Introduci numele clientului, adaugi produsele dorite de acesta iar de restul se ocupa Nova Manager. Pentru a intelege
                    mai bine cum functioneaza, foloseste urmatorul buton si creeaza prima ta factura (nu iti fa griji, o vei putea sterge mai tarziu).
                </h5>
                <div @click="showCreateMyFirstBillModal" class="btn btn-success padding create-my-first-bill-button">Creeaza prima mea factura</div>
            </div>
        </div>
    </div>
    <create-my-first-bill-modal></create-my-first-bill-modal>
</template>

<script>

import CreateMyFirstBillModal from '../../components/GetStartedPage/SecondStep/CreateMyFirstBillModal.vue';

export default {

    components: {
        'create-my-first-bill-modal': CreateMyFirstBillModal,
    },

    methods: {
        showCreateMyFirstBillModal: function() {
            this.$broadcast('showCreateMyFirstBillModal');
        },
    },

}

</script>
