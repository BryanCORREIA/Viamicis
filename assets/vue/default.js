import Vue from "vue";
import Vuesax from 'vuesax';
import App from "./App";

Vue.use(Vuesax);

new Vue({
    components: { App },
    template: "<App />"
}).$mount("#app");
