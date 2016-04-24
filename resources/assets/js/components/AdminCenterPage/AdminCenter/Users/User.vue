<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div v-if="userLoaded && !error" class="panel-heading">
            <span @click="close" class="close">&times;</span>
            {{ user.email }}

            <!-- BEGIN Dropdown -->
            <div class="dropdown pull-left pointer">
                <span class="glyphicon glyphicon-th-list dropdown-toggle" data-toggle="dropdown"></span>&nbsp;
                <ul class="dropdown-menu">

                    <!-- BEGIN Access account -->
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Accesează contul</a>
                    </li>
                    <!-- END Access account -->

                    <li class="divider"></li>

                    <disable-account :disabled="user.disabled" :user-id="user.id"></disable-account>
                    <enable-account :disabled="user.disabled" :user-id="user.id"></enable-account>
                    <delete-account :user-id="user.id"></delete-account>

                    <li class="divider"></li>

                    <change-password :user-id="user.id"></change-password>

                    <!-- BEGIN Reset password -->
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-repeat"></span>&nbsp;Resetează parola</a>
                    </li>
                    <!-- END Reset password -->
                </ul>
            </div>
            <!-- END Dropdown -->
        </div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">

            <loader v-if="loading"></loader>

            <div v-if="error" class="alert alert-danger">{{ error }}</div>

            <div v-if="userLoaded">

                <!-- BEGIN Account disabled alert -->
                <div v-show="user.disabled > 0" class="col-md-12">
                    <div class="alert alert-warning">Acest cont este dezativat.</div>
                </div>
                <!-- END Account disabled alert -->

                <!-- BEGIN Email address -->
                <div class="col-md-12">
                    <strong>Adresă de email:</strong> {{ user.email }} <span class="pull-right glyphicon glyphicon-pencil"></span>
                </div>
                <!-- END Email address -->

                <!-- BEGIN Joined -->
                <div class="col-md-12">
                    <strong>Utilizator din:</strong> 04.01.2016
                </div>
                <!-- END Joined -->

                <!-- BEGIN Subscription type -->
                <div class="col-md-12">
                    <strong>Tip abonament:</strong> Cu plată
                </div>
                <!-- END Subscription type -->

                <!-- BEGIN Bills -->
                <div class="col-md-12">
                    <strong>Facturi create:</strong> 4
                </div>
                <!-- END Bills -->

                <!-- BEGIN Clients -->
                <div class="col-md-12">
                    <strong>Clienti:</strong> 3
                </div>
                <!-- END Clients -->

                <!-- BEGIN Total revenue -->
                <div class="col-md-12">
                    <strong>Venituri produse:</strong> 44 ron
                </div>
                <!-- END Total revenue -->
            </div>
        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

    <change-password-modal :user-id="userId"></change-password-modal>

</template>

<script>

import Loader from '../../../../components/Common/Loader.vue';
import DisableAccount from '../../../../components/AdminCenterPage/AdminCenter/Users/User/DisableAccount.vue';
import EnableAccount from '../../../../components/AdminCenterPage/AdminCenter/Users/User/EnableAccount.vue';
import DeleteAccount from '../../../../components/AdminCenterPage/AdminCenter/Users/User/DeleteAccount.vue';
import ChangePassword from '../../../../components/AdminCenterPage/AdminCenter/Users/User/ChangePassword.vue';
import ChangePasswordModal from '../../../../components/AdminCenterPage/AdminCenter/Users/User/ChangePasswordModal.vue';

export default {

    props: ['userId'],

    data: function() {
        return {
            user: '',
            loading: false,
            userLoaded: false,
            error: '',
        }
    },

    ready: function() {
        this.getUser();
    },

    methods: {

        getUser: function(successCallback) {

            this.loading = true;
            var vn = this;

            this.$http.get('/admin-center/users/' + this.userId + '/get').then(function(success) {
                vn.loading = false;
                vn.user = success.data;
                vn.userLoaded = true;

                // Check if callback was given and execute
                if (typeof successCallback !== 'undefined') {
                    successCallback();
                }

            }, function(error) {

                vn.loading = false;

                if (error.data.message) {
                    vn.error = error.data.message;
                    return;
                }
                vn.error = 'O eroare a avut loc.';
            });
        },

        close: function() {
            window.location.replace('/admin-center/users');
        }

    },

    components: {
        'loader': Loader,
        'disable-account': DisableAccount,
        'enable-account': EnableAccount,
        'delete-account': DeleteAccount,
        'change-password': ChangePassword,
        'change-password-modal': ChangePasswordModal,
    },

    events: {

        'user_updated': function(title, message) {
            var vn = this;
            this.userLoaded = false;
            this.getUser(function() {
                vn.$dispatch('success_alert', title, message);
            });
        }
    }

}

</script>
