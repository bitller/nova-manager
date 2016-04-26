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
                        <td class="text-center"><div class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge</div></td>
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
        }

    }

}

</script>
