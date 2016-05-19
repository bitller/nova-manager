<template>

    <div class="panel panel-info">
        <div class="panel-heading">Numarul de facturi afisate</div>
        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="row">

                <!-- BEGIN Error -->
                <div v-if="error" class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger">{{ error }}</div>
                </div>
                <!-- END Error -->

                <div class="col-md-6 col-md-offset-3">
                    <!-- BEGIN Number of bills form -->
                    <div v-if="showForm && !loading">
                        <!-- BEGIN Input -->
                        <div class="form-group">
                            <label for="number-of-bills">Numarul de facturi afisate pe pagina</label>
                            <input v-model="number_of_bills" @keyup.enter="updateNumberOfBills" type="text" class="form-control" />
                        </div>
                        <!-- END Input -->

                        <!-- BEGIN Button -->
                        <div @click="updateNumberOfBills" :class="{ 'disabled': loading_button }" class="btn btn-block btn-primary">
                            <span v-show="!loading_button">Salveaza</span>
                            <img v-show="loading_button" src="/img/loading-bubbles.svg" />
                        </div>
                        <!-- END Button -->
                    </div>
                    <!-- END Number of bills form -->

                    <!-- BEGIN Number of bills loader -->
                    <div v-if="loading" class="col-md-12 text-center">
                        <img src="/img/loading-bubbles-big.svg" />
                    </div>
                    <!-- END Number of bills loader -->
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
            number_of_bills: '',
            error: '',
            errors: ''
        }
    },

    ready: function() {
        this.getCurrentNumberOfBills();
    },

    methods: {

        getCurrentNumberOfBills: function() {

            this.loading = true;
            var vn = this;

            this.$http.get('/dashboard/settings/displayed/get-number-of-bills').then(function(success) {

                // Handle success case
                vn.loading = false;
                vn.number_of_bills = success.data.number_of_bills;

            }, function(error) {

                vn.loading = false;
                vn.showForm = false;

                if (error.data.message) {
                    vn.error = error.data.message;
                    vn.errors = '';
                    return false;
                }

                vn.error = 'O eraore a avut loc.';
                vn.errors = '';
            });
        },

        updateNumberOfBills: function() {

            this.loading_button = true;
            var vn = this;
            var numberOfBills = {
                _token: $('#token').attr('content'),
                number_of_bills: this.number_of_bills
            };

            this.$http.post('/dashboard/settings/displayed/update-bills', numberOfBills).then(function(success) {

                // Server response is ok
                vn.loading_button = false;
                vn.number_of_bills = success.data.number_of_bills;
                vn.$dispatch('success_alert', success.data.title, success.data.message);

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
            })

        }
    }

}
</script>
