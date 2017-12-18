
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('notification', require('./components/Notification.vue'));

Vue.component('update-status', require('./components/UpdateStatus.vue'));

window.events = new Vue({});

window.flash = function (message = null, type = null) {
    window.events.$emit('flash', {
        message: message,
        type: type
    });
}

const app = new Vue({
    el: '#app',
    data: {
        sidebarState: true,
    },
    methods: {
        toggleSidebar() {
            this.sidebarState = !this.sidebarState;
        }
    }
});