import Vue from "vue";
import Vuesax from 'vuesax';
import App from "./App";

import 'vuesax/dist/vuesax.css'

Vue.use(Vuesax);

new Vue({
  components: { App },
  template: "<App/>"
}).$mount("#app");
