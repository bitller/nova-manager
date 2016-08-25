<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">{{ panelText }}</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Subiect</th>
                        <th>Utilizator</th>
                        <th>Deschide</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="1 in 5">
                        <td class="vert-align"><span :class="labelClass">{{ labelText }}</span></td>
                        <td class="vert-align">John</td>
                        <td class="vert-align">Doe</td>
                        <td @click="showTicketModal('4')" class="vert-align"><div class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></div></td>
                    </tr>
                </tbody>
            </table>

            <ul class="pager">
                <li><a @click="prevPage" href="#"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Inapoi</a></li>
                <li><a @click="nextPage" href="#">Inainte&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></a></li>
            </ul>

        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    props: ['type'],

    methods: {
        getTickets: function(url) {
            if (typeof url === 'undefined') {
                url = this.paginationUrl;
            }
            var vm = this;
            this.$http.get(url).then(function(success) {
                //
            }, function(error) {
                //
            });
        },

        nextPage: function() {
            //
        },

        prevPage: function() {
            //
        },

        showTicketModal: function(ticketId) {
            this.$dispatch('showTicketModal', ticketId);
        },
    },

    computed: {
        paginationUrl: function() {
            var base = '/admin-center/tickets/';
            if (this.type === 'closed') {
                return base + 'closed';
            }
            return base + 'opened';
        },

        labelClass: function() {
            var label = 'label label-';
            if (this.type === 'closed') {
                return label + 'success';
            }
            return label + 'danger';
        },

        labelText: function() {
            if (this.type === 'closed') {
                return 'Inchis';
            }
            return 'Deschis';
        },

        panelText: function() {
            if (this.type === 'closed') {
                return 'Tichete inchise';
            }
            return 'Tichete deschise';
        }
    }

}

</script>
