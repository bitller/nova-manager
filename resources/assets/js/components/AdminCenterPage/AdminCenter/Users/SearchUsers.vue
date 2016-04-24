<template>

    <div>
        <!-- BEGIN Search bar -->
        <div class="form-group has-feedback">
            <input v-model="search_query" @keyup.enter="search" type="text" class="form-control" placeholder="Caută utilizator după adresa de email" />
            <i class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
        <!-- END Search bar -->

        <!-- BEGIN Panel -->
        <div v-show="searched" class="panel panel-default">

            <div class="panel-heading">Rezultatele căutării</div>

            <!-- BGIN Panel body -->
            <div class="panel-body">

                <!-- BEGIN Loader -->
                <div v-show="loading" class="col-md-12 text-center">
                    <img src="/img/loading-bubbles-big.svg" />
                </div>
                <!-- END Loader -->

                <!-- BEGIN Table -->
                <table v-show="!loading && search_results.total > 0" class="table">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Tip abonament</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in search_results.data">
                            <td class="vert-align">{{ user.email }}</td>
                            <td class="vert-align">Abonament cu plata</td>
                            <td>
                                <a href="/admin-center/users/{{ user.id }}"><button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- END  Table -->

                <span v-show="search_results.total < 1"><strong>Nu există niciun utilizator cu această adresă de email.</strong></span>

            </div>
            <!-- END Panel body -->

        </div>
        <!-- END Panel -->
    </div>

</template>

<script>

export default {

    data: function() {
        return {
            searched: false,
            loading: false,
            search_query: '',
            search_results: '',
            showDividerCalls: 0,
        }
    },

    methods: {

        search: function() {
            this.loading = true;
            this.searched = true;
            var vn = this;

            // Post data
            var searchedUser = {
                _token: $('#token').attr('content'),
                search_query: this.search_query
            };

            this.$http.post('/admin-center/users/search', searchedUser).then(function (success) {

                vn.loading = false;
                this.search_results = success.data;

            }, function (error) {
                //
            });
        }
    },

}

</script>
