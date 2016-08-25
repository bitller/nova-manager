<template>

    <!-- BEGIN Modal -->
    <div id="how-to-add-products-modal" data-backdrop="static" class="modal fade" role="dialog">
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
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
                <!-- END Modal body -->

                <!-- BEGIN Modal footer -->
                <div class="modal-footer">
                    <button @click="closeModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                </div>
                <!-- END Modal footer -->

            </div>
            <!-- END Modal content -->

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    data: function() {
        return {
            modal: {
                selector: '#how-to-add-products-modal',
                title: 'Cum adaug produse unei facturi?',
                cancelButton: 'Inchide',
            },
        }
    },

    methods: {
        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        closeModal: function() {
            $(this.modal.selector).modal('hide');
        },
    },

    events: {
        'showHowToAddProductsModal': function() {
            this.showModal();
        }
    },

}

</script>
