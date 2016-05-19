<template>

    <div class="alert alert-warning">
        Ai anulat abonamentul tau in valoare de 19.99 ron.
        <span v-show="onGracePeriod">O sa aveti acces la aplicatie pana la data scadenta a abonamentului.</span>
        Foloseste butonul de mai jos pentru a-l reactiva.
    </div>

    <div @click="resumeSubscription" class="btn btn-success" data-toggle="modal" data-target="#myModal">Reactiveza abonamentul acum</div>

</template>

<script>

export default {

    data: function() {
        return {
            loading: false,
        }
    },

    props: ['onGracePeriod'],

    methods: {

        resumeSubscription: function() {
            this.loading = true;
            var vn = this;

            this.$http.get('/dashboard/settings/subscription-details/resume').then(function (success) {
                vn.loading = false;
            }, function (error) {
                vn.loading = false;
            });
        },
    }

}

</script>
