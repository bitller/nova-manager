<template>

    <div class="col-md-12">

        <div v-if="results.total > 0" class="panel panel-default">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th is="name"></th>
                        <th is="phone-number"></th>
                        <th is="email"></th>
                        <th is="orders-made"></th>
                        <th is="delete"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in results.data">
                        <td class="vert-align text-center"><img src="http://placehold.it/30x30" /><a href="/dashboard/clients/{{ client.id }}">{{ client.name }}</a></td>
                        <td class="vert-align text-center">{{ client.phone_number }}</td>
                        <td class="vert-align text-center">{{ client.email }}</td>
                        <td class="vert-align text-center">
                            <span v-if="client.number_of_bills">{{ client.number_of_bills.count; }}</span>
                            <span v-else>0</span>
                        </td>
                        <td @click="deleteClient(client.id)" class="text-center"><div class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge</div></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <span>Este afișată pagina {{ results.current_page }} din {{ results.last_page }}</span>
        </div>

        <div v-show="results.next_page_url || results.prev_page_url" class="col-md-6">
            <div @click="previousPage" :class="{ 'disabled': !results.prev_page_url }" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Pagina anterioară</div>
        </div>

        <div v-show="results.next_page_url || results.prev_page_url" class="col-md-6">
            <div @click="nextPage" :class="{ 'disabled': !results.next_page_url }" class="btn btn-primary pull-left">Pagina următoare&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></div>
        </div>

    </div>

</template>

<script>

import Name from '../../components/ClientsPage/ClientsTable/Name.vue';
import PhoneNumber from '../../components/ClientsPage/ClientsTable/PhoneNumber.vue';
import Email from '../../components/ClientsPage/ClientsTable/Email.vue';
import OrdersMade from '../../components/ClientsPage/ClientsTable/OrdersMade.vue';
import Delete from '../../components/ClientsPage/ClientsTable/Delete.vue';

export default {

    props: ['results'],

    components: {
        'name': Name,
        'phone-number': PhoneNumber,
        'email': Email,
        'orders-made': OrdersMade,
        'delete': Delete,
    },

    methods: {

        previousPage: function() {
            this.$dispatch('previous_page');
        },

        nextPage: function() {
            this.$dispatch('next_page');
        },

        deleteClient: function(clientId) {

            var vn = this;

            // Ask for confirmation
            swal({
                title: 'Sunteți sigur?',
                text: 'Toate detaliile despre acest client vor fi șterse, inclusiv facturile.',
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Anulează',
                cancelButtonColor: '#bdc3c7',
                confirmButtonColor: "#E05082",
                confirmButtonText: "Șterge clientul",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function() {
                vn.doDeleteClientRequest(clientId);
            });

        },

        doDeleteClientRequest: function(clientId) {

            var vn = this;
            var client = {
                _token: $('#token').attr('content')
            };

            this.$http.delete('/dashboard/clients/' + clientId, client).then(function (success) {

                this.$dispatch('clients_updated', success.data.title, success.data.message);

            }, function (error) {

                var title = 'Oooops.';
                var message = 'O eroare a avut loc.';

                if (error.data.message) {
                    message = error.data.message;
                }

                if (error.data.title) {
                    title = error.data.title;
                }

                swal({
                    type: 'error',
                    title: title,
                    message: message
                });
            });

        },

        numberOfBills: function(client) {
            if (client.number_of_bills[0].number_of_bills < 1) {
                return 0;
            }

            return client.number_of_bills[0].number_of_bills;
        }

    }

}

</script>
