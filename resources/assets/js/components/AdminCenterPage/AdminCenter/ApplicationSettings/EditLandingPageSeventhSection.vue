<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">A saptea sectiune a paginii principale</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <!-- BEGIN Title -->
            <div :class="{ 'has-error': titleHasError }" class="form-group">
                <label>Title:</label>
                <input v-model="title" @keyup.enter="updateSeventhSectionDetails" type="text" class="form-control" />
                <span v-show="titleHasError" class="text-danger">{{ titleHasError }}</span>
            </div>
            <!-- END Title -->

            <!-- BEGIN Description -->
            <div :class="{ 'has-error': descriptionHasError }" class="form-group">
                <label>Description:</label>
                <input v-model="description" @keyup.enter="updateSeventhSectionDetails" type="text" class="form-control" />
                <span v-show="descriptionHasError" class="text-danger">{{ descriptionHasError }}</span>
            </div>
            <!-- END Description -->

            <div @click="updateSeventhSectionDetails" class="btn btn-primary">Salveaza</div>
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
                fifthSection: '/admin-center/application-settings/landing-page-seventh-section'
            },
        }
    },

    ready: function() {
        this.getSeventhSectionDetails();
    },

    methods: {
        getSeventhSectionDetails: function() {
            var vm = this;
            this.$http.get(this.endpoints.fifthSection).then(function(success) {
                vm.title = success.data.title;
                vm.description = success.data.description;
            }, function(error) {
                //
            });
        },

        updateSeventhSectionDetails: function() {
            this.$dispatch('show_loader');
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                title: this.title,
                description: this.description
            };

            this.$http.post(this.endpoints.fifthSection, data).then(function(success) {
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
            this.errors.title = this.errors.description = '';
        },
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
    }

}

</script>
