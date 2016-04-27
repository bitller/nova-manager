<template>

    <div class="col-md-12">

        <div v-if="results.total > 0" class="panel panel-default">
            <table class="table table-hover table-bordered">
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
                        <td class="vert-align text-center">{{ client.name }}</td>
                        <td class="vert-align text-center">{{ client.phone_number }}</td>
                        <td class="vert-align text-center">{{ client.email }}</td>
                        <td class="vert-align text-center">niy</td>
                        <td @click="deleteClient(client.id)" class="text-center"><div class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge</div></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <ul class="pager">
            <li @click="previousPage"><a href="#">Pagina anterioară</a></li>
            <li><a @click="nextPage" href="#">Pagina următoare</a></li>
        </ul>

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
                confirmButtonColor: "#DD6B55",
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

        }

    }

}

</script>
