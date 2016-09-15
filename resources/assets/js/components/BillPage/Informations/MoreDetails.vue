<template>

    <div class="col-md-12">

        <!-- BEGIN Panel -->
        <div class="panel panel-info">

            <!-- BEGIN Panel heading -->
            <div class="panel-heading">
                <span>Detalii suplimentare</span>
            </div>
            <!-- END Panel heading -->

            <!-- BEGIN Panel body -->
            <div class="panel-body">
                <span v-if="currentDetails">{{ currentDetails }}</span>
                <span v-if="!currentDetails">Nu sunt adaugate detalii suplimentare.</span>
            </div>
            <!-- END Panel body -->

            <!-- BEGIN Panel footer -->
            <div class="panel-footer">
                <div @click="showEditOtherDetailsModal" class="btn btn-success">
                    <span v-show="!currentDetails">Adauga detalii suplimentare</span>
                    <span v-show="currentDetails">Editeaza detaliile suplimentare</span>
                </div>
            </div>
            <!-- END Panel footer -->

        </div>
        <!-- END Panel -->

        <edit-more-details-modal :bill-id="billId" :current-details="currentDetails"></edit-more-details-modal>

    </div>

</template>

<script>

import EditMoreDetailsModal from '../../../components/BillPage/Informations/EditMoreDetailsModal.vue';

export default {

    props: ['billId', 'currentDetails'],

    components: {
        'edit-more-details-modal': EditMoreDetailsModal,
    },

    data: function() {
        return {
            text: '',
            loading: false,
            error: '',
            otherDetails: '',
            editor: '',
            modal: {
                selector: '#edit-more-details-modal',
                title: 'Editează detaliile suplimentare ale acestei facturi'
            }
        }
    },

    methods: {

        showEditOtherDetailsModal: function() {
            this.$broadcast('showEditOtherDetailsModal');
        },

    },

    events: {
        'other_details_updated': function(otherDetails) {
            this.currentDetails = otherDetails;
        }
    },

    computed: {
        hasError: function() {
            return false;
        }
    }

}

</script>
