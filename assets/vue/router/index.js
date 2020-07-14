import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../Components/Dashboard'
import AddTrip from '../Components/Trip/AddTrip'
import JoinTrip from '../Components/Trip/JoinTrip'
import ActionTrip from "../Components/Trip/ActionTrip";
import InfoTrip from "../Components/Trip/InfoTrip";
import ListTchat from "../Components/Tchat/ListTchat";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/voyage',
            name: 'actionTrip',
            component: ActionTrip
        },
        {
            path: '/proposer-un-voyage',
            name: 'addTrip',
            component: AddTrip
        },
        {
            path: '/voyage/:id',
            name: 'infoTrip',
            component: InfoTrip
        },
        {
            path: '/rejoindre-un-voyage',
            name: 'joinTrip',
            component: JoinTrip
        },
        {
            path: '/messages',
            name: 'listTchat',
            component: ListTchat
        }
    ]
})
