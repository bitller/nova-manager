<template>

    <div class="well">Abonamentul tău lunar în valoare de 19.99 ron este activ. Următoarea plată va avea loc în mod automat în data de 19.09.2016</div>

    <div @click="cancelSubscription" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Anulează abonamentul</div>

</template>

<script>

export default {

    methods: {

        cancelSubscription: function() {

            var vn = this;

            swal({
                title: "Sunteti sigur?",
                text: "Daca dezactivati abonamentul o sa mai puteti folosi Nova pana in data 19.09.2016",
                type: "warning",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: "#EE7785",
                confirmButtonText: "Da, sunt sigur",
                cancelButtonText: 'Anuleaza',
                closeOnConfirm: false,
            }, function() {

                vn.loading = true;
                vn.$http.get('/dashboard/settings/subscription-details/cancel').then(function (success) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                }, function (error) {
                    //
                });
            });
        },

    }

}

</script>
