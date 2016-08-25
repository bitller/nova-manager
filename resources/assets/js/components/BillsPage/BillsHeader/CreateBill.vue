<style>
/*.padding {
    padding: 10px;
}*/
</style>
<template>

    <!-- BEGIN Open modal button -->
    <div class="col-md-2 col-md-offset-6">
        <div @click="showModal" class="btn btn-block btn-success padding pull-right">
            <span class="glyphicon glyphicon-plus"></span>
            <span>Creează factură</span>
        </div>
    </div>
    <!-- END Open modal button -->

    <!-- BEGIN Modal -->
    <div id="create-bill-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="hideModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                  <div class="row">
                      <div class="col-md-12">

                          <alert-danger :message="hasError"></alert-danger>

                          <!-- BEGIN Client name -->
                          <typeahead
                              class="open"
                              label="Numele clientului"
                              :items="items"
                              :query="clientName"
                              @on-query="search"
                              @on-select="selectResultsData"
                              @on-select-with-no-results="createBill"
                              :min="2"
                              :debounce="400">
                                <a><span v-html="(item.name) | highlight query"></span></a>
                            </typeahead>
                            <!-- END Client name -->

                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <div class="modal-footer">
                <button @click="hideModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                <button @click="createBill" type="button" class="btn btn-primary">{{ modal.submitButton }}</button>
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

import AlertDanger from '../../../components/Alerts/AlertDanger.vue';
import Typeahead from '../../../components/Autocomplete/Typeahead.vue';

export default {

    data: function() {
        return {
            modal: {
                selector: '#create-bill-modal',
                title: 'Creeaza factura',
                cancelButton: 'Anuleaza',
                submitButton: 'Creeaza factura',
            },

            selected: null,
            items: [],
            clientName: '',
            error: '',
        }
    },

    components: {
        'alert-danger': AlertDanger,
        'typeahead': Typeahead,
    },

    methods: {
        showModal: function() {
            if (this.creatingBill) {
                return false;
            }
            $(this.modal.selector).modal('show');
        },

        hideModal: function() {
            if (this.creatingBill) {
                return false;
            }
            $(this.modal.selector).modal('hide');
            this.emptyErrors();
            this.emptyInput();
        },

        createBill: function() {

            if (this.creatingBill) {
                return false;
            }

            this.creatingBill = true;
            var vm = this;
            var bill = {
                _token: $('#token').attr('content'),
                client_name: this.clientName
            };

            this.$http.post('/dashboard/bills/new', bill).then(function (success) {

                vm.creatingBill = false;
                vm.hideModal();
                vm.$dispatch('reloadBills');
                vm.$dispatch('success_alert', success.data.title, success.data.message);

            }, function (error) {

                vm.creatingBill = false;

                if (error.data.errors.client_name) {
                    vm.error = error.data.errors.client_name;
                    return;
                }

                vm.error = 'O eroare a avut loc. Redeschideti aplicatia pentru a incerca din nou.'

            });
        },

        search: function(query) {
            var vm = this;
            this.clientName = query;
            this.$http.get('/dashboard/bills/suggest-clients', {query: query}).then(function (success) {
                vm.items = success.data;
            }, function (error) {
                vm.items = [];
            });
        },

        selectResultsData(selectedObj, selectedIdx){
            if (selectedObj == null) {
                return false;
            }

            this.clientName = selectedObj.name;
            this.selected = this.items[selectedIdx];
            this.createBill();
        },

        emptyErrors: function() {
            this.error = '';
            this.errors = '';
        },

        emptyInput: function() {
            this.clientName = '';
        },

    },

    computed: {
        'hasError': function() {
            if (!this.creatingBill && this.error) {
                return this.error;
            }
            return false;
        }
    }

}

</script>
