<template>

    <div id="notifications" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notificări</h4>
              </div>
              <div class="modal-body">

                  <div class="row">
                      <div v-for="notification in notifications">

                          <warning v-if="notification.type == 'warning'" :notification="notification"></warning>
                          <info v-if="notification.type == 'info'" :notification="notification"></info>

                          <div class="col-md-12" v-if="showDivider($index)">
                              <div class="col-md-12"><div class="divider"></div></div>
                          </div>
                      </div>

                      <div v-if="showNoNotificationsAlert" class="col-md-12">
                          <div class="alert alert-info"><strong>Nu sunt notificări noi. Click <a href="#">aici</a> pentru a avedea notificările deja citite.</strong></div>
                      </div>

                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
              </div>
            </div>

        </div>
    </div>

</template>

<script>

import Warning from '../components/Notifications/Warning.vue';
import Info from '../components/Notifications/Info.vue';

export default {

    data: function() {
        return {
            loading: false,
            notifications: '',
        }
    },

    components: {
        'warning': Warning,
        'info': Info,
    },

    methods: {

        getNotifications: function() {

            this.loading = true;
            var vn = this;
            this.$http.get('/dashboard/announcements').then(function(success) {

                vn.loading = false;
                vn.notifications = success.data.announcements;

            }, function(error) {
                //
            });

        },

        makeUserNotificationsRead: function() {

            var vn = this;

            var postData = {
                _token: $('#token').attr('content')
            };

            this.$http.post('/dashboard/announcements/make-read', postData);

        },

        showDivider: function(index) {
            index++;
            if (this.notifications.length >= index+1) {
                return true;
            }

            return false;
        }

    },

    computed: {
        showNoNotificationsAlert: function() {
            if (this.notifications.length === 0) {
                return true;
            }

            return false;
        }
    },

    events: {
        'load_announcements': function() {
            this.getNotifications();
            this.makeUserNotificationsRead();
        }
    }

}

</script>
