import  Vue  from  'vue';
import  App  from  './App.vue';
import  router  from  './router';
import  store  from  './store';
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css";
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';
import axios from 'axios';

Vue.config.productionTip  =  false;
Vue.component('multiselect', Multiselect);
Vue.use(VueAxios, axios);
Vue.use(VueSocialauth, {
    providers: {
        google: {
            clientId: '',
            client_secret: '',
            redirectUri: 'https://flagtick.com/auth/google/callback'
        }
    }
});

new  Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')