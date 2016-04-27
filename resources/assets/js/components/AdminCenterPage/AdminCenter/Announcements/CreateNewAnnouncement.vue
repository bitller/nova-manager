<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">Creează un anunţ nou</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">

            <div class="form-horizontal" role="form">

                <div v-show="hasError" class="alert alert-danger">{{ error }}</div>

                <!-- BEGIN Announcement type -->
                <div :class="{ 'has-error': typeHasError }" class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Tip anunț</label>
                    <div class="col-md-7">
                        <select v-model="type" class="form-control">
                            <option v-for="type in announcementTypes">{{ type }}</option>
                        </select>
                        <span v-show="typeHasError" class="text-danger">{{ errors.announcement_type }}</span>
                    </div>
                </div>
                <!-- END Announcement type -->

                <!-- BEGIN Announcement title -->
                <div :class="{ 'has-error': titleHasError }" class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Titlul anunțului</label>
                    <div class="col-md-7">
                        <input v-model="title" @keyup.enter="postAnnouncement" type="text" class="form-control" />
                        <span v-show="titleHasError" class="text-danger">{{ errors.announcement_title }}</span>
                    </div>
                </div>
                <!-- END  Announcement title -->

                <!-- BEGIN Announcement content -->
                <div :class="{ 'has-error': contentHasError }" class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Conținutul anunțului</label>
                    <div class="col-md-7">
                        <textarea v-model="content" @keyup.enter="postAnnouncement" class="form-control"></textarea>
                        <span v-show="contentHasError" class="text-danger">{{ errors.announcement_content }}</span>
                    </div>
                </div>
                <!-- END Announcement content -->

                <!-- BEGIN Action button text -->
                <div :class="{ 'has-error': actionButtonTextHasError }" class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Text buton</label>
                    <div class="col-md-7">
                        <input v-model="actionButtonText" @keyup.enter="postAnnouncement" type="text" class="form-control" />
                        <span v-show="actionButtonTextHasError" class="text-danger">{{ errors.action_button_text }}</span>
                    </div>
                </div>
                <!-- END Action button text -->

                <!-- BEGIN Action button url -->
                <div :class="{ 'has-error': actionButtonUrlHasError }" class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Adresă buton</label>
                    <div class="col-md-7">
                        <input v-model="actionButtonUrl" @keyup.enter="postAnnouncement" ype="text" class="form-control" />
                        <span v-show="actionButtonUrlHasError" class="text-danger">{{ errors.action_button_url }}</span>
                    </div>
                </div>
                <!-- END Action button url -->

                <!-- BEGIN Post -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-3">
                        <div @click="postAnnouncement" class="btn btn-primary">Publică anunțul</div>
                    </div>
                </div>
                <!-- END Post -->
            </div>

        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    ready: function() {
        this.loadPageData();
    },

    data: function() {
        return {
            type: '',
            title: '',
            content: '',
            actionButtonText: '',
            actionButtonUrl: '',
            loading: false,
            loadingPageData: false,
            error: '',
            errors: '',
            announcementTypes: '',
        }
    },

    methods: {

        loadPageData: function() {

            this.loadPageData = true;
            var vn = this;

            this.$http.get('/admin-center/announcements/types').then(function (success) {

                vn.loadingPageData = false;
                vn.announcementTypes = success.data.types;

            }, function (error) {
                //
            });

        },

        postAnnouncement: function() {

            this.loading = true;
            var vn = this;

            // Post data
            var announcement = {
                _token: $('#token').attr('content'),
                announcement_type: this.type,
                announcement_title: this.title,
                announcement_content: this.content,
                action_button_url: this.actionButtonUrl,
                action_button_text: this.actionButtonText
            };

            this.$http.post('/admin-center/announcements', announcement).then(function (success) {

                vn.$dispatch('announcements_updated');
                vn.$dispatch('success_alert', success.data.title, success.data.message);
                vn.resetForm();

            }, function (error) {

                vn.loading = false;

                if (error.data.errors) {
                    vn.errors = error.data.errors;
                    vn.error = '';
                    return;
                }

                if (error.data.error) {
                    vn.error = error.data.error;
                    vn.errors = '';
                    return;
                }

                vn.error = 'O eroare a avut loc.';
                vn.errors = '';

            });

        },

        resetForm: function() {
            this.errors = this.error = this.title = this.content = this.actionButtonUrl = this.actionButtonText = '';
        },

    },

    computed: {

        hasError: function() {
            if (this.error && !this.loading) {
                return true;
            }

            return false;
        },

        typeHasError: function() {
            if (this.errors.announcement_type && !this.loading) {
                return true;
            }

            return false;
        },

        titleHasError: function() {
            if (this.errors.announcement_title && !this.loading) {
                return true;
            }

            return false;
        },

        contentHasError: function() {
            if (this.errors.announcement_content && !this.loading) {
                return true;
            }

            return false;
        },

        actionButtonUrlHasError: function() {
            if (this.errors.action_button_url && !this.loading) {
                return true;
            }

            return false;
        },

        actionButtonTextHasError: function() {
            if (this.errors.action_button_text && !this.loading) {
                return true;
            }

            return false;
        }
    }

}

</script>
