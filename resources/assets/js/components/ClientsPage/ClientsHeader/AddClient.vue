<template>

    <div class="col-md-2 col-md-offset-3">
        <div class="btn btn-success pull-right" data-toggle="modal" data-target="#add-client-modal">
            <span class="glyphicon glyphicon-plus"></span>
            <span>Adaugă client</span>
        </div>
    </div>

    <!-- BEGIN Modal -->
    <div id="add-client-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <span v-show="nameHasError" class="text-danger">{{ errors.name }}</span>
                          </div>
                          <!-- END Client name -->

                          <!-- BEGIN Client email -->
                          <div :class="{ 'has-error': emailHasError }" class="form-group">
                              <label>Email-ul clientului</label>
                              <input @keyup.enter="addClient" v-model="email" type="text" class="form-control" />
                              <span v-show="emailHasError" class="text-danger">{{ errors.email }}</span>
                          </div>
                          <!-- END Client email -->

                          <!-- BEGIN Client phone number -->
                          <div :class="{ 'has-error': phoneNumberHasError }" class="form-group">
                              <label>Numărul de telefon al clientului</label>
                              <input @keyup.enter="addClient" v-model="phoneNumber" type="text" class="form-control" />
                              <span v-show="phoneNumberHasError" class="text-danger">{{ errors.phone_number }}</span>
                          </div>
                          <!-- END Client phone number -->

                          <div class="checkbox">
                              <label><input v-model="wishHappyBirthDay" type="checkbox" />Doresc ca clientul să primescă o urare de ziua lui</label>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
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
            loading: ''
        }
    },

    methods: {
        addClient: function() {

            this.loading = true;
            var vn = this;

            var client = {
                _token: $('#token').attr('content'),
                name: this.name,
                email: this.email,
                phone_number: this.phoneNumber,
                wish_happy_birth_day: this.wishHappyBirthDay,
                birth_day: this.birthDay
            };

            this.$http.post('/dashboard/clients', client).then(function (success) {

                $('#add-client-modal').modal('hide');
                this.$dispatch('clients_updated', success.data.title, success.data.message);

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

        }
    },

    computed: {

        hasError: function() {
            if (this.error && !this.loading) {
                return true;
            }
            return false;
        },

        nameHasError: function() {
            if (this.errors.name && !this.loading) {
                return true;
            }
            return false;
        },

        emailHasError: function() {
            if (this.errors.email && !this.loading) {
                return true;
            }
            return false;
        },

        phoneNumberHasError: function() {
            if (this.errors.phone_number && !this.loading) {
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
