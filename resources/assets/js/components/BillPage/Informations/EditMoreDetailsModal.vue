<template>

    <!-- BEGIN Modal -->
    <div id="edit-more-details-modal" data-backdrop="static" class="modal fade" role="dialog">
        <!-- BEGIN Modal dialog -->
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div v-show="hasError" class="alert alert-danger">{{ hasError }}</div>
                            <div class="form-group">
                                <label>Detalii suplimentare</label>
                                <textarea v-model="currentDetails" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Modal body -->

                <!-- BEGIN Modal footer -->
                <div class="modal-footer">
                    <button @click="closeModal" type="button" :class="{ 'disabled': loading }" class="btn btn-default">{{ modal.cancelButtonText }}</button>
                    <button @click="editOtherDetails" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">{{ modal.confirmButtonText }}</button>
                        <!-- <span v-show="!loading">Editează reducerea</span> -->
                        <!-- <img v-show="loading" src="/img/loading-bubbles.svg" /> -->
                    <!-- </button> -->
                </div>
                <!-- END Modal footer -->
            </div>
            <!-- END Modal content -->

        </div>
        <!-- END Modal dialog -->
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    props: ['currentDetails', 'billId'],

    data: function() {
        return {
            modal: {
                title: 'Editeaza informatiile suplimentare',
                selector: '#edit-more-details-modal',
                confirmButtonText: 'Salvează',
                cancelButtonText: 'Anulează',
            },
            inputs: {
                otherDetails: '',
            },
            error: '',
            urls: {
                post: {
                    editOtherDetails: '/dashboard/bills/' + this.billId + '/edit-other-details',
                },
            },
        }
    },

    methods: {

        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        closeModal: function() {
            $(this.modal.selector).modal('hide');
            this.clearErrors();
            this.clearInputs();
        },

        editOtherDetails: function() {
            this.$dispatch('show_loader');
            var vm = this;

            var postData = {
                _token: $('#token').attr('content'),
                other_details: this.currentDetails
            };

            // Make post request
            this.$http.post(this.urls.post.editOtherDetails, postData).then(function (success) {
                vm.$dispatch('success_alert', success.data.title, success.data.message);
                vm.closeModal();
                vm.$dispatch('other_details_updated', success.data.other_details);
            }, function (error) {
                // Check if a server error occurred (other than validation) and stop execution
                if (!error.data.other_details) {
                    vm.$dispatch('error_alert', 'Ooops.', 'O eroare a avut loc. Reimprospatati pagina pentru a incerca din nou.');
                    vm.closeModal();
                    return;
                }

                // Check if a validation error occurred
                if (error.data.other_details) {
                    vm.$dispatch('close_opened_alert');
                    vm.error = error.data.other_details;
                    return;
                }
            });
        },

        clearErrors: function() {
            this.error = '';
        },

        clearInputs: function() {
            this.inputs.otherDetails = '';
        },
    },

    events: {
        'showEditOtherDetailsModal': function() {
            this.showModal();
        }
    }

}

</script>
