<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Schimba parola contului</div>
        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="row">

                <error :error="error"></error>

                <!-- BEGIN Change account password from -->
                <div class="col-md-6 col-md-offset-3">

                        <!-- BEGIN Current password -->
                        <div :class="{ 'has-error': showErrorForCurrentPassword }" class="form-group">
                            <label for="current-password">Parola actuala</label>
                            <input v-model="current_password" @keyup.enter="changeAccountPassword" type="password" id="current-password" class="form-control" />
                            <span v-if="showErrorForCurrentPassword" class="text-danger">{{ errors.current_password }}</span>
                        </div>
                        <!-- END Current password -->

                        <!-- BEGIN New password  -->
                        <div :class="{ 'has-error': showErrorForNewPassword }" class="form-group">
                            <label for="new-password">Alege o noua parola</label>
                            <input v-model="new_password" @keyup.enter="changeAccountPassword" type="password" id="new-password" class="form-control" />
                            <span v-if="showErrorForNewPassword" class="text-danger">{{ errors.new_password}}</span>
                        </div>
                        <!-- END New password -->

                        <!-- BEGIN New password confirmation -->
                        <div :class="{ 'has-error': showErrorForNewPasswordConfirmation }" class="form-group">
                            <label for="new-password-confirmation">Reintroduceti noua parola</label>
                            <input v-model="new_password_confirmation" @keyup.enter="changeAccountPassword" type="password" id="new-password-confirmation" class="form-control" />
                            <span v-if="showErrorForNewPasswordConfirmation" class="text-danger">{{ errors.new_password_confirmation }}</span>
                        </div>
                        <!-- END New password confirmation -->

                        <!-- BEGIN Save button -->
                        <div @click="changeAccountPassword" :class="{ 'disabled': loading }" class="btn btn-block btn-primary">
                            <span v-show="!loading">Salveaza</span>
                            <img v-show="loading" src="/img/loading-bubbles.svg" />
                        </div>
                        <!-- END Save button -->
                </div>
                <!-- END Change account password form -->

            </div>
        </div>
        <!-- END Panel body -->
    </div>
    <!-- END Panel -->

</template>

<script>

import  Error from '../../../../components/SettingsPage/Error.vue';

export default {

    components: {
        'error': Error,
    },

    data: function() {
        return {
            loading: false,
            current_password: '',
            new_password: '',
            new_password_confirmation: '',
            error: '',
            errors: ''
        }
    },

    methods: {

        changeAccountPassword: function() {

            this.loading = true;
            var vn = this;

            // Post data
            var newPassword = {
                _token: $('#token').attr('content'),
                current_password: this.current_password,
                new_password: this.new_password,
                new_password_confirmation: this.new_password_confirmation
            };

            this.$http.post('/dashboard/settings/security/update-account-password', newPassword).then(function(success) {

                // Handle success response
                vn.loading = false;
                vn.$dispatch('success_alert', success.data.title, success.data.message);
                vn.resetFields();

            }, function(error) {

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

        resetFields: function() {
            // Reset fields
            this.current_password = this.new_password = this.new_password_confirmation = '';
        }
    },

    computed: {

        showErrorForCurrentPassword: function() {
            if (!this.loading && this.errors.current_password) {
                return true;
            }

            return false;
        },

        showErrorForNewPassword: function() {
            if (!this.loading && this.errors.new_password) {
                return true;
            }

            return false;
        },

        showErrorForNewPasswordConfirmation: function() {
            if (!this.loading && this.errors.new_password_confirmation) {
                return true;
            }

            return false;
        }
    }

}
</script>
