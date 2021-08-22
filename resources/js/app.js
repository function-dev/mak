/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('role-component', require('./components/RoleComponent.vue').default);
Vue.component('dropdown-component', require('./components/DropDownComponent.vue').default);
Vue.component('decks-component', require('./components/DecksComponent.vue').default);
Vue.component('deck-component', require('./components/DeckComponent.vue').default);
Vue.component('new-deck-component', require('./components/NewDeckComponent.vue').default);
Vue.component('new-card-component', require('./components/NewCardComponent.vue').default);
Vue.component('sessions-component', require('./components/SessionsComponent.vue').default);
Vue.component('new-session-component', require('./components/NewSessionComponent.vue').default);
Vue.component('roles-list-component', require('./components/RolesListComponent.vue').default);


Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('game-component', require('./components/GameComponent.vue').default);

Vue.directive('click-outside', {
    bind(el, binding) {
        el.addEventListener('click', e => e.stopPropagation());
        document.body.addEventListener('click', binding.value);
    },
    unbind(el, binding) {
        document.body.removeEventListener('click', binding.value);
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
