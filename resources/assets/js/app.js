
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('channels-container', require('./components/ChannelsContainer.vue'));
Vue.component('channel-chat', require('./components/ChannelChat.vue'));
Vue.component('chat-messages', require('./components/ChannelChat.vue'));
Vue.component('chat-form', require('./components/MessageForm.vue'));

// window.events will be a event bus using a vue instance <3
window.events = new Vue();

let authorizations = require('./authorizations');

Vue.mixin({
    methods: {
        authorize(...params){
            if (! window.App.user) return false;

            if (typeof params[0] === 'string') {
                return authorizations[params[0]](params[1]);
            }

            return params[0](window.App.user);
        },

        isLogged() {
            return window.App.user !== null;
        },

        ago(date){
            return window.moment(date).fromNow();
        }
    }
});

const app = new Vue({
    el: '#app'
});
