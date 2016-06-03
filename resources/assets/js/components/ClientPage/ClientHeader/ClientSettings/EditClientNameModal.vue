<template>

    <!-- BEGIN Modal -->
    <div id="edit-client-name-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">Editează numele clientului</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                  <div class="row">

                      <div v-show="loading" class="col-md-10 col-md-offset-1 text-center">
                          <img src="/img/loading-bubbles-big-primary.svg" />
                      </div>

                      <div v-show="!loading" class="col-md-10 col-md-offset-1">

                          <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                          <!-- BEGIN Client name -->
                          <div class="form-group">
                              <label>Numele clientului</label>
                              <input @keyup.enter="updateName" v-model="name" type="text" class="form-control" />
                          </div>
                          <!-- END Client name -->

                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <!-- BEGIN Modal footer -->
              <div class="modal-footer">
                  <button type="button" :class="{ 'disabled': cancelButtonIsDisabled }" class="btn btn-default" data-dismiss="modal">Anulează</button>
                  <button @click="updateName" type="button" :class="{ 'disabled': submitButtonIsDisabled }" class="btn btn-primary">
                      <img v-show="updatingName" src="/img/loading-bubbles.svg" />
                      <span v-show="!updatingName">Salvează</span>
                  </button>
              </div>
              <!-- END Modal footer -->
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    data: function() {
        return {
            modalId: '#edit-client-name-modal',
            clientId: $('#client').attr('content'),
            loading: false,
            updatingName: false,
            name: '',
            error: '',
        }
    },

    methods: {

        getCurrentName: function() {

            this.loading = true;
            var vn = this;
            this.$http.get('/dashboard/clients/' + this.clientId + '/basic-informations').then(function (success) {
                vn.loading = false;
                vn.name = success.data.name;
            }, function (error) {

            });
        },

        updateName: function() {

            this.updatingName = true;
            var vn = this;

            // Post data
            var data = {
                _token: $('#token').attr('content'),
                name: this.name,
            };

            this.$http.post('/dashboard/clients/' + this.clientId + '/update-name', data).then(function (success) {
                vn.updatingName = false;
                vn.name = success.data.name;
            }, function (error) {
                //
            });

        },

        closeModal: function() {
            if (this.loading || this.updatingName) {
                return false;
            }

            $('#edit-client-name-modal').modal('hide');
        },

    },

    watch: {
        'updatingName': function(value) {

            var backdrop = 'true';
            var keyboard = true;

            if (value) {
                backdrop = 'static';
                keyboard = false;
            }

            $(this.modalId).modal({
                backdrop: 'static',
                keyboard: keyboard,
            });
        },
    },

    events: {
        'edit_client_name_modal_clicked': function() {
            this.getCurrentName();
        },
    },

    computed: {
        hasError: function() {
            //
        },

        cancelButtonIsDisabled: function() {
            if (this.loading || this.updatingName) {
                return true;
            }
            return false;
        },

        submitButtonIsDisabled: function() {
            if (this.loading || this.updatingName) {
                return true;
            }
            return false;
        },
    },

}

</script>
