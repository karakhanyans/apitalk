import ListStore from "./components/store/ListStore";
import CreateStore from "./components/store/CreateStore";
import EditStore from "./components/store/EditStore";
import Detail from "./components/store/Detail";
import Send from "./components/contactMessage/Send";
import SignUp from "./components/auth/SignUp";
import SignIn from "./components/auth/SignIn";
import Logout from "./components/auth/Logout";

export const routes = [
    {
        path: '/stores', component: ListStore,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/store/create', component: CreateStore,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/store/edit/:id', component: EditStore,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/store/:id', component: Detail,
        meta: {
            requiresAuth: true
        }
    },
    {path: '/contact', component: Send},
    {path: '/auth/signup', component: SignUp},
    {path: '/', component: SignIn},
    {path: '/auth/signin', component: SignIn},
    {path: '/auth/logout', component:Logout }
];
