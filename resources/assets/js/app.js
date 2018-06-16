
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

Vue.component(    'dic',                require('./components/ExampleComponent.vue')  );
Vue.component(     'dictionary-view', require('./components/dictionary.vue')  );
Vue.component(      'recorder',           require('./components/record'));



const app = new Vue({
    el: '#app',
    data:{
        words: [],

    },
    methods:{
        addMessage(message){
            //addmessage to existing messages

        }
    },
    created(){
        axios.get('api/dictionary').then(response=>{
            //this.words = response.data;
            console.log(response.data);
            console.log('created');

        });

    }

});
