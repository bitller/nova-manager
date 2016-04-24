<template>

    <!-- BEGIN Enable account -->
    <li v-show="disabled > 0">
        <a @click="enableAccount" href="#"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Activează contul</a>
    </li>
    <!-- END Enable account -->

</template>

<script>

export default {

    props: ['disabled', 'userId'],

    methods: {

        enableAccount: function() {
            var vn = this;
            // Ask user to confirm action
            swal({
                title: 'Sunteți sigur?',
                text: 'Odată activat, utlizatorul va putea accesa contul din nou.',
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Anulează',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Da, sunt sigur",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function() {
                vn.doEnableAccountRequest();
            });

        },

        doEnableAccountRequest: function() {
            var vn = this;

            this.$http.get('/admin-center/users/' + vn.userId + '/enable-account').then(function (success) {

                // Handle success response
                vn.$dispatch('user_updated', success.data.title, success.data.message);

            }, function (error) {

                // Set default response title and message and replace with server title and message, if given
                var title = 'Ooops.';
                var message = 'O eroare a avut loc.';
                if (error.data.title) {
                    title = error.data.title;
                }
                if (error.data.message) {
                    message = error.data.message;
                }

                vn.$dispatch('error_alert', title, message);
            });
        }

    }

}

</script>
