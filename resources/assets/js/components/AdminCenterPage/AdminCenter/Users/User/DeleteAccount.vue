<template>

    <!-- BEGIN Delete account -->
    <li>
        <a @click="deleteAccount" href="#"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge contul</a>
    </li>
    <!-- END Delete account -->

</template>

<script>

export default {

    props: ['userId'],

    methods: {

        deleteAccount: function() {
            var vn = this;

            // Ask user to confirm action
            swal({
                title: 'Sunteți sigur?',
                text: 'Odată dezactivat, utlizatorul nu va mai putea accesa contul.',
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Anulează',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Da, sunt sigur",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function() {
                vn.doDeleteAccountRequest();
            });
        },

        doDeleteAccountRequest: function() {

            var vn = this;

            this.$http.get('/admin-center/users/' + this.userId + '/delete-account').then(function (success) {

                swal({
                    type: 'success',
                    title: success.data.title,
                    text: success.data.message
                });
                window.location.replace('/admin-center/users');

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
