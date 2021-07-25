import Vue from "vue";
import Router from "vue-router";
import store from "../store";
import Home from "../views/Home.vue";
import Blogs from "../views/Blogs.vue";
import About from "../views/About.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
// Folder User
import User from "../views/users/User.vue";
import CreateUser from "../views/users/CreateUser.vue";
import EditUser from "../views/users/EditUser.vue";
// Folder Roles
import Roles from "../views/roles/Role.vue";
import CreateRole from "../views/roles/Create.vue";
import EditRole from "../views/roles/Edit.vue";

import ContactUs from "../views/ContactUs.vue";
import Faqs from "../views/Faq.vue";
import Plans from "../views/PlansPricing.vue";
import Terms from "../views/Terms.vue";
import Privacy from "../views/Privacy.vue";

import NotFound from "../views/PageNotFound.vue";

Vue.use(Router);

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/blogs",
        name: "Blogs",
        component: Blogs,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    // Route User
    {
        path: "/user",
        name: "User",
        component: User,
        meta:{
            needsAuth: true
        },
    },
    {
        path: "/user/:id",
        name: "Edit User",
        component: EditUser,
        meta:{
            needsAuth: true
        },
    },
    {
        path: '/users/create',
        name: 'Create User',
        component: CreateUser,
        meta:{
            needsAuth: true
        },
    },
    // Route Roles
    {
        path: "/role",
        name: "Roles",
        component: Roles,
        meta: {
            needsAuth: true
        }
    },
    {
        path: "/role/create",
        name: "Create Roles",
        component: CreateRole,
        meta: {
            needsAuth: true
        }
    },
    {
        path: "/role/:id",
        name: "Edit Role",
        component: EditRole,
        meta: {
            needsAuth: true
        }
    },
    {
        path: "/register",
        name: "Register",
        component: Register
    },
    {
        path: "/login",
        name: "Login",
        component: Login

    },
    {
        path: "/contact-us",
        name: "ContactUs",
        component: ContactUs
    },
    {
        path: "/faqs",
        name: "Faqs",
        component: Faqs
    },
    {
        path: "/plans",
        name: "Plans",
        component: Plans
    },
    {
        path: "/terms",
        name: "Terms",
        component: Terms
    },
    {
        path: "/privacy",
        name: "Privacy",
        component: Privacy
    },
    {
        path: "/:catchAll(.*)*",
        name: "Notfound",
        component: NotFound
    }
]
export const router = new Router({
    mode: "hash",
    linkActiveClass: "active",
    // linkExactActiveClass: "exact-active",
    routes
});

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.name + ' | Facebook Tools' || 'Facebook Tools';
    });
});

router.beforeEach((to, from, next) => {
    var loggedIn = store.state.auth.status.loggedIn;
    if(to.matched.some(record => record.meta.needsAuth)){
        if(!loggedIn){
            next({
                path: '/login'
            })
        }else{
            next()
        }
    }
    else{
        next()
    }
})

export default router;
