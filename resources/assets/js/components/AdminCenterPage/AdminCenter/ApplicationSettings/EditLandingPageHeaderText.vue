<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">Antetul paginei principale</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="form-group" :class="{ 'has-error': headerTextHasError }">
                <input @keyup.enter="updateHeaderText" v-model="headerText" type="text" class="form-control" />
                <span v-show="headerTextHasError" class="text-danger">{{ headerTextHasError }}</span>
            </div>
            <div @click="updateHeaderText" class="btn btn-primary">Salvează</div>
        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    data: function() {
        return {
            headerText: '',
            errors: {
                headerText: ''
            },
            endpoints: {
                headerText: '/admin-center/application-settings/landing-page-header-text',
            }
        }
    },

    ready: function() {
        this.getCurrentHeaderText();
    },

    methods: {

        getCurrentHeaderText: function() {
            var vm = this;
            this.$http.get(this.endpoints.headerText).then(function (success) {
                vm.headerText = success.data.header_text;
            }, function (error) {
                //
            });
        },

        updateHeaderText: function() {

            this.$dispatch('show_loader');

            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                header_text: this.headerText,
            };

            this.$http.post(this.endpoints.headerText, data).then(function (success) {
                vm.emptyErrors();
                vm.$dispatch('success_alert', success.data.title, success.data.message);
            }, function (error) {

                if (error.data.header_text) {
                    vm.errors.headerText = error.data.header_text;
                    vm.$dispatch('close_opened_alert');
                    return;
                }

                vm.$dispatch('error_alert', 'Ooops.', 'O eroare avut loc.');
            });
        },

        emptyErrors: function() {
            this.errors.headerText = '';
        }
    },

    computed: {
        headerTextHasError: function() {
            if (this.errors.headerText) {
                return this.errors.headerText;
            }
            return false;
        }
    }

}

</script>
