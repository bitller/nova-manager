<template>

    <div v-show="displayError" class="alert alert-danger">{{ error }}</div>

    <!-- BEGIN Email input -->
    <div :class="{ 'has-error': displayEmailError }" class="form-group has-feedback">
        <input v-model="email" @keyup.enter="login" id="login-email" type="text" class="form-control" placeholder="Emailul dvs">
        <span v-show="displayEmailError" class="text-danger">{{ errors.email }}</span>
        <i class="glyphicon glyphicon-user form-control-feedback icon-color"></i>
    </div>
    <!-- END Email input -->

    <!-- BEGIN Password input -->
    <div :class="{ 'has-error': displayPasswordError }" class="form-group has-feedback">
        <input v-model="password" @keyup.enter="login" type="password" class="form-control" placeholder="parola">
        <span v-show="displayPasswordError" class="text-danger">{{ errors.password }}</span>
        <i class="glyphicon glyphicon-lock form-control-feedback icon-color"></i>
    </div>
    <!-- END Password input -->

    <!-- BEGIN Login button -->
    <div class="form-group login-button">
        <button @click="login" :class="{ 'disabled': loading }" class="btn-block btn btn-primary">
            <img v-show="loading" class="img-responsive center-responsive-image" src="/img/loading-bubbles.svg" />
            <span v-show="!loading">login</span>
        </button>
    </div>
    <!-- END Login button -->

</template>

<script>
export default {

    data: function() {
        return {
            email: '',
            password: '',
            errors: '',
            error: '',
            loading: false
        }
    },

    methods: {
        login: function() {

            this.loading = true;

            var vn = this;
            var credentials = {
                _token: $('#token').attr('content'),
                email: this.email,
                password: this.password
            };

            this.$http.post('/login', credentials).then(function(success) {
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

                vn.error = 'O eroare a avut loc.';
                vn.errors = '';
            });
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
        }
    }

}
</script>