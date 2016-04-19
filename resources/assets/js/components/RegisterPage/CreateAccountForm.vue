<template>

    <div v-show="displayError" class="alert alert-danger">{{ error }}</div>

    <!-- BEGIN Email -->
    <div :class="{ 'has-error': displayEmailError }" class="form-group">
    <input v-model="email" @keyup.enter="register" class="form-control border-input" type="text" placeholder="Care este adresa dumneavoastră de email?" />
<span v-show="displayEmailError" class="text-danger">{{ errors.email }}</span>
</div>
<!-- END Email -->

<!-- BEGIN Password -->
<div :class="{ 'has-error': displayPasswordError }" class="form-group">
<input v-model="password" @keyup.enter="register" class="form-control border-input" type="password" placeholder="Alegeți o parolă" />
<span v-show="displayPasswordError" class="text-danger">{{ errors.password }}</span>
</div>
<!-- END Password -->

<!-- BEGIN Confirm password -->
<div :class="{ 'has-error': displayPasswordConfirmationError }" class="form-group">
<input v-model="password_confirmation" @keyup.enter="register" class="form-control border-input" type="password" placeholder="Reintroduceți parola aleasă" />
<span v-show="displayPasswordConfirmationError" class="text-danger">{{ errors.password_confirmation }}</span>
</div>
<!-- END Confirm password -->

<div class="form-group register-button">
    <button @click="register" :class="{ 'disabled': loading }" class="btn-block btn btn-primary">
    <img v-show="loading" class="img-responsive center-responsive-image" src="/img/loading-bubbles.svg" />
    <span v-show="!loading">Creează contul</span>
</button>
</div>

</template>

<script>
export default {

    data: function () {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            loading: false,
            errors: '',
            error: ''
        }
    },

    computed: {
        displayError: function() {
            if (this.error && !this.loading) {
                return true;
            }

            return false;
        },

        displayEmailError: function() {
            if (this.errors.email && !this.loading) {
                return true;
            }

            return false;
        },

        displayPasswordError: function() {
            if (this.errors.password && !this.loading) {
                return true;
            }

            return false;
        },

        displayPasswordConfirmationError: function() {
            if (this.errors.password_confirmation && !this.loading) {
                return true;
            }

            return false;
        }
    },

    methods: {
        register: function() {

            this.loading = true;
            var vn = this;

            var user = {
                _token: $('#token').attr('content'),
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }

            this.$http.post('/register', user).then(function(success) {
                window.location.replace(success.data.redirect_to);
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

                vn.error = 'O eroare a avut loc. Reîncărcați pagina pentru a încerca din nou.'
                vn.errors = '';
            });

        }
    }

}
</script>