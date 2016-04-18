// jQuery and Vue
window.jQuery = window.$ = require('jquery');
require('bootstrap-sass');
var Vue = require('vue');

var typeahead = require("typeahead.js-browserify");
typeahead.loadjQueryPlugin();

// Vue resource, used for ajax requests
Vue.use(require('vue-resource'));

// Enable debug mode
Vue.config.debug = true;

import RegisterPage from './components/RegisterPage.vue';
import BillsPage from './components/BillsPage.vue';

new Vue({
    
    el: '#app',
    
    components: {
        'register-page': RegisterPage,
        'bills-page': BillsPage
    }
});