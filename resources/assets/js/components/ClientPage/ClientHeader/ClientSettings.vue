<template>

    <!-- BEGIN Client settings -->
    <div class="col-sm-1 col-md-2">
        <div class="dropdown">

            <!-- BEGIN Dropdown button -->
            <button class="btn btn-primary btn-block dropdown-toggle" type="button" data-toggle="dropdown">
                Setări client&nbsp;<span class="caret"></span>
            </button>
            <!-- END Dropdown button -->

            <!-- BEGIN Dropdown menu -->
            <ul class="dropdown-menu">
                <!-- BEGIN Edit client name option -->
                <li @click="editClientNameModalClicked" data-toggle="modal" data-target="#edit-client-name-modal">
                    <a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Editează numele clientului</a>
                </li>
                <!-- END Edit client name option -->

                <!-- BEGIN Edit client email option -->
                <li data-toggle="modal" data-target="#edit-client-email-modal">
                    <a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Editează adresa de email a clientului</a>
                </li>
                <!-- END Edit client email option -->

                <!-- BEGIN Edit client phone number option -->
                <li data-toggle="modal" data-target="#edit-client-phone-number-modal">
                    <a href="#"><span class="glyphicon glyphicon-phone"></span>&nbsp;Editează numărul de telefon al clientului</a>
                </li>
                <!-- END Edit client phone number option -->

                <li class="divider"></li>

                <!-- BEGIN Messages on special occasions -->
                <li data-toggle="modal" data-target="#messages-on-special-occasions-modal">
                    <a href="#"><span class="glyphicon glyphicon-star"></span>&nbsp;Mesaje cu ocazii speciale</a>
                </li>
                <!-- END Messages on special occasions -->

                <li class="divider"></li>

                <!-- BEGIN Delete client -->
                <li>
                    <a href="#"><span class="glyphicon glyphicon-trash"></span>&nbsp;Șterge acest client</a>
                </li>
                <!-- END Delete client -->
            </ul>
            <!-- END Dropdown menu -->
        </div>
    </div>
    <!-- END Client settings -->

    <edit-client-name-modal></edit-client-name-modal>

</template>

<script>

import EditClientNameModal from '../../../components/ClientPage/ClientHeader/ClientSettings/EditClientNameModal.vue';
import EditClientEmailModal from '../../../components/ClientPage/ClientHeader/ClientSettings/EditClientEmailModal.vue';
import EditClientPhoneNumberModal from '../../../components/ClientPage/ClientHeader/ClientSettings/EditClientPhoneNumberModal.vue';

export default {

    components: {
        'edit-client-name-modal': EditClientNameModal,
        'edit-client-email-modal': EditClientEmailModal,
        'edit-client-phone-number-modal': EditClientPhoneNumberModal,
    },

    methods: {
        editClientNameModalClicked: function() {
            this.$broadcast('edit_client_name_modal_clicked');
        },
    }

}

</script>
