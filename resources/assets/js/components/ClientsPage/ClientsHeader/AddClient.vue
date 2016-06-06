<template>

    <div class="col-md-2">
        <div @click="showModal" class="btn btn-success pull-right">
            <span class="glyphicon glyphicon-plus"></span>
            <span>Adaugă client</span>
        </div>
    </div>

    <!-- BEGIN Modal -->
    <div id="add-client-modal" data-backdrop="static" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button @click="hideModal" type="button" class="close">&times;</button>
                <h4 class="modal-title">Adaugă client</h4>
              </div>
              <div class="modal-body">

                  <div class="row">
                      <div class="col-md-10 col-md-offset-1">

                          <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                          <!-- BEGIN Client name -->
                          <div :class="{ 'has-error': nameHasError }" class="form-group">
                              <label>Numele clientului</label>
                              <input @keyup.enter="addClient" v-model="name" type="text" class="form-control" />
                              <span v-show="nameHasError" class="text-danger">{{ errors.client_name }}</span>
                          </div>
                          <!-- END Client name -->

                          <!-- BEGIN Client email -->
                          <div :class="{ 'has-error': emailHasError }" class="form-group">
                              <label>Email-ul clientului</label>
                              <input @keyup.enter="addClient" v-model="email" type="text" class="form-control" />
                              <span v-show="emailHasError" class="text-danger">{{ errors.client_email }}</span>
                          </div>
                          <!-- END Client email -->

                          <!-- BEGIN Client phone number -->
                          <div :class="{ 'has-error': phoneNumberHasError }" class="form-group">
                              <label>Numărul de telefon al clientului</label>
                              <input @keyup.enter="addClient" v-model="phoneNumber" type="text" class="form-control" />
                              <span v-show="phoneNumberHasError" class="text-danger">{{ errors.client_phone_number }}</span>
                          </div>
                          <!-- END Client phone number -->

                          <div class="checkbox">
                              <label><input v-model="wishHappyBirthDay" type="checkbox" /><strong>Doresc ca clientul să primescă o urare de ziua lui</strong></label>
                          </div>

                          <div :class="{ 'has-error': birthDayHasError }" class="form-group">
                              <label>Data de naștere a clientului</label>
                              <input @keyup.enter="addClient" v-model="birthDay" type="text" class="form-control client-birthday" />
                              <span v-show="birthDayHasError" class="text-danger">{{ errors.birth_day }}</span>
                          </div>

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button @click="hideModal" type="button" class="btn btn-default">Anulează</button>
                <button @click="addClient" type="button" class="btn btn-primary">Adaugă client</button>
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    ready: function() {
        $('.client-birthday').datepicker();
    },

    data: function() {
        return {
            name: '',
            email: '',
            phoneNumber: '',
            birthDay: '',
            wishHappyBirthDay: '',
            error: '',
            errors: '',
            loading: '',
            modalSelector: '#add-client-modal',
        }
    },

    methods: {

        showModal: function() {
            $(this.modalSelector).modal('show');
        },

        hideModal: function() {
            if (this.loading) {
                return false;
            }
            this.emptyInputs();
            this.emptyErrors();
            $(this.modalSelector).modal('hide');
        },

        addClient: function() {

            this.loading = true;
            var vn = this;

            var client = {
                _token: $('#token').attr('content'),
                client_name: this.name,
                client_email: this.email,
                client_phone_number: this.phoneNumber,
                wish_happy_birth_day: this.wishHappyBirthDay,
                birth_day: this.birthDay
            };

            this.$http.post('/dashboard/clients', client).then(function (success) {

                vn.loading = false;
                vn.hideModal();
                vn.$dispatch('reload_clients', success.data.title, success.data.message);

            }, function (error) {

                vn.loading = false;

                if (error.data.errors) {
                    vn.errors = error.data.errors;
                    vn.error = '';
                    return;
                }

                if (error.data.message) {
                    vn.errors = '';
                    vn.error = error.data.message;
                    return;
                }

                vn.errors = '';
                vn.error = 'O eroare a avut loc.';

            });

        },

        emptyInputs: function() {
            this.email = this.phoneNumber = this.name = this.birthDay = '';
        },
    },

    computed: {

        hasError: function() {
            if (this.error && !this.loading) {
                return true;
            }
            return false;
        },

        nameHasError: function() {
            if (this.errors.client_name && !this.loading) {
                return true;
            }
            return false;
        },

        emailHasError: function() {
            if (this.errors.client_email && !this.loading) {
                return true;
            }
            return false;
        },

        phoneNumberHasError: function() {
            if (this.errors.client_phone_number && !this.loading) {
                return true;
            }
            return false;
        },

        birthDayHasError: function() {
            if (this.errors.birth_day && !this.loading) {
                return true;
            }
            return false;
        },
    },

}

</script>
