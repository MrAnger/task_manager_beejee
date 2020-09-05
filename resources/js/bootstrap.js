import Vue from 'vue';

window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

import BootstrapVue from "bootstrap-vue";
Vue.use(BootstrapVue);