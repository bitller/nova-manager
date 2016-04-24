<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Schimbă adresa de email</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="col-md-6 col-md-offset-3">

                <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                <!-- BEGIN Input -->
                <div :class="{ 'has-error': emailHasError }" class="form-group">
                    <label for="email-address">Email</label>
                    <input v-model="email" @keyup.enter="changeEmail" type="text" class="form-control" />
                    <span v-show="emailHasError" class="text-danger">{{ errors.email }}</span>
                </div>
                <!-- END Input -->

                <!-- BEGIN Save -->
                <div @click="changeEmail" :class="{ 'disabled': loading }" class="btn btn-primary btn-block">
                    <span v-show="!loading">Salvează</span>
                    <img v-show="loading" src="/img/loading-bubbles.svg" />
                </div>
                <!-- END Save -->

            </div>
        </div>
        <!-- END Panel body -->
    </div>

</template>

<script>
export default {

    data: function() {
        return {
            error: '',
            errors: '',
            loading: false,
            email: '',
            loadingEmail: false,
        }
    },

    ready: function() {
        this.getEmail();
    },

    methods: {

        getEmail: function() {

            this.loadingEmail = true;
            var vn = this;

            this.$http.get('/dashboard/settings/profile/get-email').then(function (success) {
                vn.loadingEmail = false;
                vn.email = success.data.email;
            }, function (error) {
                //
            });

        },

        changeEmail: function() {

            this.loading = true;
            var vn = this;
            var email = {
                _token: $('#token').attr('content'),
                email: this.email
            };

            this.$http.post('/dashboard/settings/profile/change-email', email).then(function (success){

                vn.loading = false;
                vn.error = vn.errors = '';
                vn.$dispatch('success_alert', success.data.title, success.data.message);

            }, function (error) {

                vn.loading = false;

                if (error.data.errors) {
                    this.errors = error.data.errors;
                    this.error = '';
                    return;
                }

                if (error.data.error) {
                    this.error = error.data.error;
                    thie.errors = '';
                    return;
                }

                this.error = 'O eroare a avut loc.';
                this.errors = '';
            });

        },

    },

    computed: {

        'hasError': function() {
            if (this.error && !this.loading) {
                return true;
            }

            return false;
        },

        'emailHasError': function() {
            if (this.errors.email && !this.loading) {
                return true;
            }

            return false;
        }

    }

}
</script>
