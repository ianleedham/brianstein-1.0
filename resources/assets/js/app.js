
import VueRouter from 'vue-router';
import router from './routes';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(     'dictionary-view', require('./components/dictionary/dictionary.vue')  );
Vue.component(     'flash-cards', require('./components/dictionary/flashcards/flashcards.vue')  );
Vue.component(     'brians-canvas-two', require('./components/brians_canvas/index.vue')  );
Vue.component(     'quiz', require('./components/quiz/index.vue')  );
Vue.component(     'portfolio', require('./components/index/projects.vue')  );
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);


Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app',
    router
});
