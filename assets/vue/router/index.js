import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../Components/Dashboard'
import AddTrip from '../Components/Trip/AddTrip'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/proposer-un-voyage',
            name: 'addTrip',
            component: AddTrip
        }
    ]
})
