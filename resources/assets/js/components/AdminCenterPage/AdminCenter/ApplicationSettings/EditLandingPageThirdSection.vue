<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">A treia sectiune a paginei principale</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <!-- BEGIN Title -->
            <div :class="{ 'has-error': titleHasError }" class="form-group">
                <label>Titlu:</label>
                <input v-model="title" @keyup.enter="updateThirdSectionDetails" type="text" class="form-control" />
                <span v-show="titleHasError" class="text-danger">{{ titleHasError }}</span>
            </div>
            <!-- END Title -->

            <!-- BEGIN Description -->
            <div :class="{ 'has-error': descriptionHasError }" class="form-group">
                <label>Descriere:</label>
                <textarea v-model="description" @keyup.enter="updateThirdSectionDetails" class="form-control"></textarea>
                <span v-show="descriptionHasError" class="text-danger">{{ descriptionHasError }}</span>
            </div>
            <!-- END Description -->

            <div @click="updateThirdSectionDetails" class="btn btn-primary">Salvează</div>

        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    data: function() {
        return {
            title: '',
            description: '',
            errors: {
                title: '',
                description: ''
            },
            endpoints: {
                thirdSection: '/admin-center/application-settings/landing-page-third-section'
            },
        }
    },

    ready: function() {
        this.getThirdSectionDetails();
    },

    methods: {

        getThirdSectionDetails: function() {
            var vm = this;
            this.$http.get(this.endpoints.thirdSection).then(function(success) {
                vm.title = success.data.title;
                vm.description = success.data.description;
            }, function(error) {
                //
            });
        },

        updateThirdSectionDetails: function() {
            this.$dispatch('show_loader');
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                title: vm.title,
                description: vm.description
            };

            this.$http.post(vm.endpoints.thirdSection, data).then(function(success) {
                vm.emptyErrors();
                vm.$dispatch('success_alert', success.data.title, success.data.message);
            }, function(error) {
                if (error.data.title) {
                    vm.errors.title = error.data.title;
                }
                if (error.data.description) {
                    vm.errors.description = error.data.description;
                }

                if (vm.hasError) {
                    vm.$dispatch('close_opened_alert');
                    return;
                }

                vm.$dispatch('error_alert', 'Ooops', 'O eroare a avut loc.');
            });
        },

        emptyErrors: function() {
            this.errors.title = this.errors.message = '';
        }
    },

    computed: {
        hasError: function() {
            if (this.titleHasError || this.descriptionHasError) {
                return true;
            }
            return false;
        },

        titleHasError: function() {
            if (this.errors.title) {
                return this.errors.title;
            }
            return false;
        },

        descriptionHasError: function() {
            if (this.errors.description) {
                return this.errors.description;
            }
            return false;
        }
    },

}

</script>
