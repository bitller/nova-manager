<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">A doua sectiune a paginei principale</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">

            <!-- BEGIN Title -->
            <div class="form-group" :class="{ 'has-error': titleHasError }">
                <label>Titlu</label>
                <input v-model="title" @keyup.enter="updateSecondSectionDetails" type="text" class="form-control" />
                <span v-show="titleHasError" class="text-danger">{{ titleHasError }}</span>
            </div>
            <!-- END Title -->

            <!-- BEGIN Description -->
            <div class="form-group" :class="{ 'has-error': descriptionHasError }">
                <label>Descriere</label>
                <textarea v-model="description" class="form-control"></textarea>
                <span v-show="descriptionHasError" class="text-danger">{{ descriptionHasError }}</span>
            </div>
            <!-- END Description -->

            <!-- BEGIN Button text -->
            <div class="form-group" :class="{ 'has-error': buttonTextHasError }">
                <label>Text buton</label>
                <input v-model="buttonText" @keyup.enter="updateSecondSectionDetails" type="text" class="form-control" />
                <span v-show="buttonTextHasError" class="text-danger">{{ buttonTextHasError }}</span>
            </div>
            <!-- END Button text -->

            <div @click="updateSecondSectionDetails" class="btn btn-primary">Salvează</div>
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
            buttonText: '',
            errors: {
                title: '',
                description: '',
                buttonText: '',
            },
            endpoints: {
                secondSection: '/admin-center/application-settings/landing-page-second-section'
            }
        }
    },

    ready: function() {
        this.getSecondSectionDetails();
    },

    methods: {
        getSecondSectionDetails: function() {
            var vm = this;
            this.$http.get(this.endpoints.secondSection).then(function (success) {
                vm.title = success.data.title;
                vm.description = success.data.description;
                vm.buttonText = success.data.button_text;
            }, function (error) {
                //
            });
        },

        updateSecondSectionDetails: function() {
            this.$dispatch('show_loader');

            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                title: this.title,
                description: this.description,
                button_text: this.buttonText
            };

            this.$http.post(this.endpoints.secondSection, data).then(function (success) {
                vm.emptyErrors();
                vm.$dispatch('success_alert', success.data.title, success.data.message);
            }, function (error) {
                if (error.data.title) {
                    this.errors.title = error.data.title;
                }
                if (error.data.message) {
                    this.errors.message = error.data.message;
                }
                if (error.data.button_text) {
                    this.errors.buttonText = error.data.buttonText;
                }

                if (this.hasError) {
                    vm.$dispatch('close_opened_alert');
                    return;
                }

                vm.$dispatch('error_alert', 'Ooops.', 'O eroare a avut loc.');
            });
        },

        emptyErrors: function() {
            this.errors.title = this.errors.message = this.errors.buttonText = '';
        },

    },

    computed: {
        hasError: function() {
            if (this.errors.title || this.errors.message || this.errors.buttonText) {
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

        messageHasError: function() {
            if (this.errors.message) {
                return this.errors.message;
            }
            return false;
        },

        buttonTextHasError: function() {
            if (this.errors.buttonText) {
                return this.errors.buttonText;
            }
            return false;
        },
    },

}

</script>
