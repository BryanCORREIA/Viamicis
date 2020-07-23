import Vue from 'vue'
import Router from 'vue-router'
import Home from '../Components/Blog/Home.vue'
import List from '../Components/Blog/List.vue'
import Add from '../Components/Blog/Add.vue'
import Article from "../Components/Blog/Article";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/parcourir',
            name: 'list',
            component: List
        },,
        {
            path: '/rediger',
            name: 'add',
            component: Add
        },
        {
            path: '/articles/:slug',
            name: 'article',
            component: Article
        }
    ]
})
