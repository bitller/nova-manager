/*<style>

.other-details-editor {
    min-height: 60px;
}

</style>

<template>

    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <span @click="showEditMoreDetailsModal">Detalii suplimentare &nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></span>
            </div>
            <div class="panel-body">
                <div>{{ currentDetails }}</div>
                <!-- <textarea>other details goes here</textarea> -->
                <!-- <div v-if="currentDetails === ''" class="other-details-editor"></div> -->
                <!-- <div v-if="currentDetails !== ''" class="other-details-editor">{{{ currentDetails }}}</div> -->
            </div>
            <div class="panel-footer">
                <div @click="editOtherDetails" class="btn btn-success">Salveaza</div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    props: ['currentDetails'],

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

    ready: function() {
        var vm = this;
        setTimeout(function() {
            vm.initMediumEditor();
        }, 100);
    },

    watch: {
        'currentDetails': function(value) {
            // console.log(value);
            this.initMediumEditor();

        }
    },

    methods: {

        initMediumEditor: function() {

            var config = {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline']
                }
            };

            // Config placeholder
            if (this.currentDetails === '') {
                config.placeholder = {
                    text: 'Click aici pentru a adăuga detalii suplimentare. Selectați o porțiune din text pentru a vedea opțiunile de stilizare.',
                    hideOnClick: true
                }
            } else {
                config.placeholder = false;
            }

            var MediumEditor = require('medium-editor');
            this.editor = new MediumEditor('.other-details-editor', config);
        },

        getPlaceholder: function() {
            console.log(this.currentDetails);
            // if (this.currentDetails !== '') {
            //     return false;
            // }
            return {
                text: 'Adăugați detaliile suplimentare aici. Selectați o porțiune din text pentru a vedea opțiunile de stilizare.',
                hideOnClick: true
            };
        },

        showEditMoreDetailsModal: function() {
            $(this.modal.selector).modal('show');
        },

        editOtherDetails: function() {

            if (this.loading) {
                return false;
            }

            this.loading = true;
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                other_details: this.editor.getContent()
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/edit-other-details', data).then(function (success) {

                vm.$dispatch('reloadOtherDetails', function() {
                    vm.loading = false;
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                    vm.closeModal();
                });

            }, function (error) {

                if (typeof error.data.errors !== 'undefined' && this.error.data.errors.other_details) {
                    vm.error = error.data.errors.other_details;
                    return;
                }

                vm.error = 'O eroare a avut loc.';

            });

        },

        hideModal: function() {

            if (this.loading) {
                return false;
            }

            $(this.modal.selector).modal('hide');
            this.error = this.otherDetails = '';

        },

    },

    computed: {
        hasError: function() {
            return false;
        }
    }

}

</script>*/
