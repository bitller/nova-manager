// jQuery, bootstrap and Vue
window.jQuery = window.$ = require('jquery');
require('bootstrap-sass');
var Vue = require('vue');

// Import typeahead, used for auto complete
var typeahead = require("typeahead.js-browserify");
typeahead.loadjQueryPlugin();

// Sweetalert, used for alerts
require('sweetalert');

// Vue resource, used for ajax requests
Vue.use(require('vue-resource'));

// Enable debug mode
Vue.config.debug = true;

import Notifications from './components/Notifications.vue';
import LoginPage from './components/LoginPage.vue';
import RegisterPage from './components/RegisterPage.vue';
import BillsPage from './components/BillsPage.vue';
import SettingsPage from './components/SettingsPage.vue';
import AdminCenterPage from './components/AdminCenterPage.vue';
import ClientsPage from './components/ClientsPage.vue';

new Vue({

    el: '#app',

    ready: function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    },

    components: {
        'notifications': Notifications,
        'login-page': LoginPage,
        'register-page': RegisterPage,
        'bills-page': BillsPage,
        'settings-page': SettingsPage,
        'admin-center-page': AdminCenterPage,
        'clients-page': ClientsPage,
    },

    methods: {

        loadAnnouncements: function() {
            this.$broadcast('load_announcements');
        }

    },

    events: {
        'success_alert': function(title, message) {
            swal({
                type: 'success',
                title: title,
                text: message,
                timer: 3000,
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false
            });
        },

        'error_alert': function(title, message) {
            swal({
                type: 'error',
                title: title,
                text: message,
                closeOnConfirm: false,
                showConfirmButton: false,
                timer: 3000
            });
        }
    }
});