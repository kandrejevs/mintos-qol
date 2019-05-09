import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import Vue2Filters from 'vue2-filters'
import axios from './utils/axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = true;
Vue.use(Vue2Filters);
Vue.use(VueAxios, axios);

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
