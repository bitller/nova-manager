<template>

    <!-- BEGIN Disable account -->
    <li v-show="disabled < 1">
        <a @click="disableAccount" href="#"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Dezactivează contul</a>
    </li>
    <!-- END Disable account -->

</template>

<script>

export default {

    props: ['disabled', 'userId'],

    methods: {

        disableAccount: function() {

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
                vn.doDisableAccountRequest();
            });
        },

        doDisableAccountRequest: function() {
            var vn = this;

            // Make request
            this.$http.get('/admin-center/users/' + vn.userId + '/disable-account').then(function (success) {

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
