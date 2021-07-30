import  Vue  from  'vue';
import  App  from  './App.vue';
import  router  from  './router';
import  store  from  './store';
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css";
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';
import axios from 'axios';
import VueToastify from "vue-toastify";
import VueQuillEditor from 'vue-quill-editor';
import 'quill/dist/quill.core.css'; // require styles of Text editor
import 'quill/dist/quill.snow.css'; // require styles of Text editor
import 'quill/dist/quill.bubble.css'; // require styles of Text editor

Vue.config.productionTip  =  false;
Vue.use(VueToastify,{
    theme:'light',
    position: 'top-right',
    my: "settings"
});
Vue.use(VueQuillEditor);
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