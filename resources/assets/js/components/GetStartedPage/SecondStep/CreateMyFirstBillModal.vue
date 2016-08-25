<template>

    <!-- BEGIN Modal -->
    <div id="create-my-first-bill-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title grey-middle">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                  <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-info">Intorduceti numele clientului caruia ii este destinata aceasta factura.</div>
                          <div :class="{ 'has-error': clientNameHasError }" class="form-group">
                              <label class="grey-middle">Numele clientului</label>
                              <input v-model="clientName" @keyup.enter="createBill" class="form-control" />
                              <span v-show="clientNameHasError" class="text-danger">{{ clientNameHasError }}</span>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <div class="modal-footer">
                <button @click="closeModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                <button @click="createBill" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ modal.submitButton }}</button>
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    data: function() {
        return {
            clientName: '',
            modal: {
                selector: '#create-my-first-bill-modal',
                title: 'Creeaza prima ta factura',
                submitButton: 'Creeaza prima mea factura',
                cancelButton: 'Anuleaza',
            },
            errors: {
                clientName: ''
            },
            endpoints: {
                createMyFirstBill: '/dashboard/get-started/create-my-first-bill',
            },
        }
    },

    methods: {
        createBill: function() {
            this.$dispatch('show_loader');
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                client_name: this.clientName,
            };

            this.$http.post(this.endpoints.createMyFirstBill, data).then(function(success) {
                vm.$dispatch('success_alert', success.data.title, success.data.message);
                vm.closeModal();
                window.location.replace(success.data.redirect_url);
            }, function(error) {
                if (error.data.client_name) {
                    this.errors.clientName = error.data.client_name;
                    vm.$dispatch('close_opened_alert');
                    return;
                }
                vm.$dispatch('error_alert', 'Ooops.', 'O eroare a avut loc.');
                vm.closeModal();
            });
        },

        closeModal: function() {
            $(this.modal.selector).modal('hide');
            this.emptyErrors();
            this.emptyInputs();
        },

        showModal: function() {
            $(this.modal.selector).modal('show');
        },

        emptyErrors: function() {
            this.errors.clientName = '';
        },

        emptyInputs: function() {
            this.clientName = '';
        }
    },

    computed: {
        clientNameHasError: function() {
            if (this.errors.clientName) {
                return this.errors.clientName;
            }
            return false;
        }
    },

    events: {
        'showCreateMyFirstBillModal': function() {
            this.showModal();
        },
    }

}

</script>
