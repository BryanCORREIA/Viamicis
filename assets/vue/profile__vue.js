import Vue from "vue";
import Vuesax from 'vuesax';
import Profile from "./Profile";
import router from "./router";

Vue.use(Vuesax);

new Vue({
    el: '#profile',
    router,
    data: {
        user: null,
        username: ''
    },
    components: { Profile },
    template: '<Profile :user="this.user" />',
    beforeMount: function() {
        this.user = JSON.parse(this.$el.attributes['data-user'].value);
        this.username = this.user.username;
    }
});
