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

import LoginPage from './components/LoginPage.vue';
import RegisterPage from './components/RegisterPage.vue';
import BillsPage from './components/BillsPage.vue';
import SettingsPage from './components/SettingsPage.vue';

new Vue({

    el: '#app',

    components: {
        'login-page': LoginPage,
        'register-page': RegisterPage,
        'bills-page': BillsPage,
        'settings-page': SettingsPage,
    }
});
