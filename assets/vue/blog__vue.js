import Vue from "vue";
import Vuesax from 'vuesax';
import Blog from "./Blog";
import router from "./router_blog";

var filter = function(text, length, clamp){
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
};

Vue.filter('truncate', filter);

Vue.use(Vuesax, {
    colors: {
        primary: '#EF7763'
    }
});

new Vue({
    el: '#blog',
    router,
    components: { Blog },
    template: '<Blog />'
});
