// jQuery and Vue
window.jQuery = window.$ = require('jquery');
var Vue = require('vue');

// Vue resource, used for ajax requests
Vue.use(require('vue-resource'));

// Enable debug mode
Vue.config.debug = true;

import RegisterPage from './components/RegisterPage.vue';

new Vue({
    
    el: '#app',
    
    components: {
        'register-page': RegisterPage
    }
});