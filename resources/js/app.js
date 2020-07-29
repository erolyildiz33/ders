

require('./bootstrap');
import VueMask from 'v-mask';
window.Vue = require('vue');
Vue.use(VueMask);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('randevu-form', require('./components/RandevuFormComponent.vue').default);

const app = new Vue({
    el: '#app',
});
