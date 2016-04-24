<template>

    <!-- BEGIN Modal -->
    <div id="change-user-password-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- BEGIN Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schimbă parola utilizatorului</h4>
                </div>
                <div class="modal-body">

                    <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                    <!-- BEGIN New password -->
                    <div :class="{ 'has-error': newPasswordHasError }" class="form-group">
                        <label for="new-password">Introduceți o parolă nouă</label>
                        <input v-model="new_password" @keyup.enter="changePassword" type="password" id="new-password" class="form-control" />
                        <span v-show="newPasswordHasError" class="text-danger">{{ errors.new_password }}</span>
                    </div>
                    <!-- END New password -->

                    <!-- BEGIN New password confirmation -->
                    <div :class="{ 'has-error': newPasswordConfirmationHasError }" class="form-group">
                        <label for="new-password-confirmation">Confirmați parola</label>
                        <input v-model="new_password_confirmation" @keyup.enter="changePassword" type="password" id="new-password-confrimation" class="form-control" />
                        <span v-show="newPasswordConfirmationHasError" class="text-danger">{{ errors.new_password_confirmation }}</span>
                    </div>
                    <!-- END New password confirmation -->

                </div>
                <div class="modal-footer">
                    <button @click="changePassword" :class="{ 'disabled': loading }" class="btn btn-primary">
                        <span v-show="!loading">Schimbă parola</span>
                        <img v-show="loading" src="/img/loading-bubbles.svg" />
                    </button>
                    <button type="button" :class="{ 'disabled': loading }" class="btn btn-default" data-dismiss="modal">Anulează</button>
                </div>
            </div>
            <!-- END Modal content -->

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    props: ['userId'],

    data: function() {
        return {
            loading: false,
            new_password: '',
            new_password_confirmation: '',
            errors: '',
            error: '',
        }
    },

    methods: {

        changePassword: function() {

            this.loading = true;
            this.reset();
            var vn = this;

            // Post data
            var newPassword = {
                _token: $('#token').attr('content'),
                new_password: this.new_password,
                new_password_confirmation: this.new_password_confirmation
            };

            this.$http.post('/admin-center/users/' + this.userId + '/change-password', newPassword).then(function (success) {

                vn.loading = false;
                $('#change-user-password-modal').modal('hide');
                vn.$dispatch('success_alert', success.data.title, success.data.message);

            }, function (error) {

                vn.loading = false;

                if (error.data.errors) {
                    vn.errors = error.data.errors;
                    vn.error = '';
                    return;
                }

                if (error.data.error) {
                    vn.error = error.data.error;
                    vn.errors = '';
                    return;
                }

                vn.error = 'O eroare a avut loc.';
                vn.errors = '';
            });

        },

        reset: function() {
            this.new_password = '';
            this.new_password_confirmation = '';
            this.error = '';
            this.errors = '';
        },

    },

    computed: {

        newPasswordHasError: function() {
            if (this.errors.new_password && !this.loading) {
                return true;
            }

            return false;
        },

        newPasswordConfirmationHasError: function() {
            if (this.errors.new_password_confirmation && !this.loading) {
                return true;
            }

            return false;
        },

        hasError: function() {
            if (this.error && !this.loading) {
                return true;
            }

            return false;
        },

    }

}

</script>
