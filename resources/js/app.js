require('./bootstrap');
require('./components/index');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
});
