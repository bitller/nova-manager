<template>

    <div class="panel panel-default">
        <div class="panel-heading">Numarul de clienti afisati</div>
        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="row">
                <!-- BEGIN Error -->
                <div v-show="error" class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger">{{ error }}</div>
                </div>
                <!-- END Error -->

                <div class="col-md-6 col-md-offset-3">
                    <!-- BEGIN Number of clients form -->
                    <div v-if="showForm && !loading">
                        <!-- BEGIN Input -->
                        <div class="form-group">
                            <label for="number-of-clients">Numarul de clienti afisati pe pagina</label>
                            <input v-model="number_of_clients" @keyup.enter="updateNumberOfClients" type="text" id="number-of-clients" class="form-control" />
                        </div>
                        <!-- END Input -->

                        <!-- BEGIN Button -->
                        <div @click="updateNumberOfClients" :class="{ 'disabled': loading_button }" class="btn btn-block btn-primary">
                            <span v-show="!loading_button">Salveaza</span>
                            <img v-show="loading_button" src="/img/loading-bubbles.svg" />
                        </div>
                        <!-- END Button -->
                    </div>
                    <!-- END Number of clients form -->

                    <!-- BEGIN Number of clients loader -->
                    <div v-if="loading" class="col-md-12 text-center">
                        <img src="/img/loading-bubbles-big.svg" />
                    </div>
                    <!-- END Number of clients loader -->
                </div>
            </div>
        </div>
        <!-- END Panel body -->
    </div>

</template>

<script>
export default {

    data: function() {
        return {
            loading: false,
            loading_button: false,
            showForm: true,
            number_of_clients: '',
            error: '',
            errors: ''
        }
    },

    ready: function() {
        this.getCurrentNumberOfClients();
    },

    methods: {

        getCurrentNumberOfClients: function() {

            this.loading = true;
            var vn = this;

            this.$http.get('/dashboard/settings/clients/get').then(function(success) {

                // Server response is ok
                vn.loading = false;
                vn.number_of_clients = success.data.number_of_clients;

            }, function(error) {

                // Server response contain errors
                vn.loading = false;
                vn.showForm = false;

                if (error.data.message) {
                    vn.error = error.data.message;
                    vn.errors = '';
                    return;
                }

                vn.error = 'O eroare a avut loc.';
                vn.errors = '';
            });
        },

        updateNumberOfClients: function() {

            this.loading_button = true;
            var vn = this;
            var numberOfClients = {
                _token: $('#token').attr('content'),
                number_of_clients: this.number_of_clients
            };

            this.$http.post('/dashboard/settings/clients/update', numberOfClients).then(function(success) {

                // Handle case when server response is ok
                vn.loading_button = false;
                vn.number_of_clients = success.data.number_of_clients;
                swal({
                    type: 'success',
                    title: success.data.title,
                    text: success.data.message,
                    timer: 3000,
                    showCancelButton: false,
                    showConfirmButton: false,
                    closeOnConfirm: false
                });
            }, function(error) {

                vn.loading_button = false;

                if (error.data.errors) {
                    vn.errors = error.data.errors;
                    vn.error = '';
                    return;
                }

                if (error.data.message) {
                    vn.error = error.data.message;
                    vn.errors = '';
                    return;
                }

                vn.error = 'O eroare a avut loc.';
                vn.errors = '';
            });
        }
    }

}
</script>
