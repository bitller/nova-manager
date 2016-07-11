// jQuery, bootstrap and Vue
window.jQuery = window.$ = require('jquery');
require('bootstrap-sass');
var Vue = require('vue');

window.braintree = require('braintree-web');

// Import typeahead, used for auto complete
var typeahead = require("typeahead.js-browserify");
typeahead.loadjQueryPlugin();

// Sweetalert, used for alerts
require('sweetalert');
require('bootstrap-datepicker');
require('bootstrap-select');
require('chart.js');
require('trumbowyg');

window.colors = {
    success: '#60C5BA',
    warning: '#F0AD4E',
    danger: '#e74c3c',
}

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
import ClientPage from './components/ClientPage.vue';
import ProductsPage from './components/ProductsPage.vue';
import BillPage from './components/BillPage.vue';
import SupportPage from './components/SupportPage.vue';
import StatisticsPage from './components/StatisticsPage.vue';

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
        'client-page': ClientPage,
        'products-page': ProductsPage,
        'bill-page': BillPage,
        'support-page': SupportPage,
        'statistics-page': StatisticsPage,
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
        },

        'show_loader': function() {
            swal({
                type: 'info',
                title: 'Loading...',
                // text: message,
                closeOnConfirm: false,
                showConfirmButton: false,
                timer: 3000
            });
        },

        'confirmation': function(config, confirmCallback, cancelCallback) {

            if (!config.title) {
                config.title = 'Sunteți sigur?';
            }
            if (!config.type) {
                config.type = 'warning';
            }
            if (!config.message) {
                config.message = 'Sigur doriți să continuați?';
            }
            if (!config.cancelButtonText) {
                config.cancelButtonText = 'Anulează';
            }
            if (!config.cancelButtonColor) {
                config.cancelButtonColor = '#bdc3c7';
            }
            if (!config.confirmButtonColor) {
                config.confirmButtonColor = '#E05082';
            }
            if (!config.confirmButtonText) {
                config.confirmButtonText = 'Sunt sigur';
            }

            swal({
                title: config.title,
                text: config.message,
                type: "warning",
                showCancelButton: true,
                cancelButtonText: config.cancelButtonText,
                cancelButtonColor: config.cancelButtonColor,
                confirmButtonColor: config.confirmButtonColor,
                confirmButtonText: config.confirmButtonText,
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function(confirmed) {

                if (confirmed) {
                    if (typeof confirmCallback !== 'undefined') {
                        confirmCallback();
                    }
                    return;
                }

                if (typeof cancelCallback !== 'undefined') {
                    cancelCallback();
                }

            });
        },

        'close_opened_alert': function() {
            swal.close();
        }
    }
});
