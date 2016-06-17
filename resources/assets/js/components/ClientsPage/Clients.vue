<template>

    <div class="col-md-12">

        <!-- BEIGN Clients -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Clienții dumneavoastră</span>
            </div>
        </div>

        <div class="col-md-12 white last">
            <div class="col-md-12">

                <div v-show="showNoSearchResults" class="alert alert-warning">
                    Cautarea <strong>{{ searched }}</strong> nu a returnat niciun rezultat. Incearcati cu alt nume, numar de telefon sau adresa de email.
                </div>

                <div v-show="showClientsTable" class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Nume</th>
                                <th class="text-center">Număr de telefon</th>
                                <th class="text-center">Adresă de email</th>
                                <th class="text-center">Comenzi efectuate</th>
                                <th class="text-center">Șterge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="client in clients.data">
                                <td class="text-center vert-align"><span class="client-name-in-table"><a href="/dashboard/clients/{{client.id}}">{{ client.name }}</a></span></td>
                                <td class="text-center vert-align">{{ showClientPhoneNumber(client) }}</td>
                                <td class="text-center vert-align">{{ showClientEmail(client) }}</td>
                                <td class="text-center vert-align">{{ showClientNumberOfBills(client) }}</td>

                                <td class="text-center vert-align">
                                    <div @click="askForDeleteClientConfirmation(client.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div v-show="showPageNumber" class="col-md-12">
                <span class="grey">Este afișată pagina {{ clients.current_page}} din {{ clients.last_page }}</span>
            </div>

            <!-- BEGIN Pagination -->
            <div v-show="showPagination" class="col-md-6">
                <div @click="previousPage" :class="{ 'disabled': !clients.prev_page_url }" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
            </div>
            <div v-show="showPagination" class="col-md-6">
                <div @click="nextPage" :class="{ 'disabled': !clients.next_page_url }" class="btn btn-primary pull-left">Pagina următoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>
            </div>
            <!-- END Pagination -->

        </div>
        <!-- END Clients -->

    </div>

</template>

<script>

export default {

    data: function() {
        return {
            loading: false,
            clients: '',
            searched: false,
        }
    },

    ready: function() {
        this.getClients();
    },

    methods: {

        getClients: function(url, callback) {

            this.loading = true;
            var vn = this;

            // Assign default url if required
            if (typeof url === 'undefined') {
                url = '/dashboard/clients/get';
            }

            this.$http.get(url).then(function (success) {
                vn.clients = success.data;
                vn.$dispatch('clients_updated', success.data.total, vn.searched);

                // Check if a callback was given
                if (typeof callback !== 'undefined') {
                    callback();
                }
            }, function (error) {
                //
            });

        },

        previousPage: function() {
            if (!this.clients.prev_page_url) {
                return false;
            }

            this.getClients(this.clients.prev_page_url);
        },

        nextPage: function() {
            if (!this.clients.next_page_url) {
                return false;
            }

            this.getClients(this.clients.next_page_url);
        },

        askForDeleteClientConfirmation: function(clientId) {

            var vn = this;

            swal({
                title: "Sigur doriți să ștergeți acest client?",
                text: "Deasemenea toate facturile clientului vor fi șterse.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: colors.warning,
                confirmButtonText: "Șterge clientul",
                cancelButtonText: "Anulează",
                cancelButtonColor: colors.grey,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                vn.deleteClient(clientId);
            });
        },

        deleteClient: function(clientId) {

            var vn = this;
            var data = {
                _token: $('#token').attr('content'),
            }

            this.$http.delete('/dashboard/clients/' + clientId, data).then(function (success) {

                // Build ajax url
                var currentPage = vn.clients.current_page;

                if ((vn.clients.to - vn.clients.from) + 1 < 2) {
                    currentPage--;
                }

                var url = '/dashboard/clients/get?page=' + currentPage;

                if (vn.searched) {
                    url += '&search-query=' + vn.searched;
                }

                vn.getClients(url, function() {
                    vn.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                var title = 'Ooops.';
                var message = 'O eroare a avut loc. Reimrpospatati pagina si incercati din nou.';

                if (error.data.title) {
                    title = error.data.title;
                }
                if (error.data.message) {
                    message = error.data.message;
                }
                vn.$dispatch('error_alert', title, message);
            });

        },

        /**
         * Return number of bills for given client. 0 is returned if client does not have bills.
         *
         * @param  client
         * @return int
         */
        showClientNumberOfBills: function(client) {
            if (client.number_of_bills == null) {
                return 0;
            }

            return client.number_of_bills.count;
        },

        showClientPhoneNumber: function(client) {
            if (client.phone_number == null || !client.phone_number) {
                return 'Nu a fost setat';
            }

            return client.phone_number;
        },

        showClientEmail: function(client) {
            if (client.email == null || client.email == "") {
                return 'Nu a fost setat';
            }

            return client.email;
        },

    },

    computed: {

        showClientsTable: function() {
            if (this.clients.total > 0) {
                return true;
            }

            return false;
        },

        showNoSearchResults: function() {
            if (this.clients.total < 1 && this.searched) {
                return true;
            }

            return false;
        },

        showPagination: function() {
            if (this.clients.next_page_url || this.clients.prev_page_url) {
                return true;
            }

            return false;
        },

        showPageNumber: function() {
            if (this.clients.last_page > 0) {
                return true;
            }

            return false;
        },

    },

    events: {

        'search': function(term) {
            this.getClients('/dashboard/clients/get?search-query=' + term);
            this.searched = term;
        },

        'reload_clients': function (title, message) {
            var vn = this;
            this.getClients('/dashboard/clients/get', function () {
                vn.$dispatch('success_alert', title, message);
            });
        },

    },

}

</script>
