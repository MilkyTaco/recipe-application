import Home from "../components/Home/Home";
import Menu from "../components/Home/Menu";
import AddRecipe from "../components/Home/AddRecipe";
import ListRecipe from "../components/Home/ListRecipe";

import Unauthorized from "../components/Unauthorized/Unauthorized";
import Login from "../components/Unauthorized/content/Login";
import Register from "../components/Unauthorized/content/Register";
import Landing from "../components/Landing/Landing";

import store from "../store/store";

export const routes = [
  { path: "/", component: Landing },
  {
    path: "/unauth",
    component: Unauthorized,
    children: [
      {
        path: "login",
        component: Login,
        beforeEnter(to, from, next) {
          store.commit("message/setError", null);
          store.commit("message/setSuccess", null);
          next();
        },
      },
      {
        path: "signup",
        component: Register,
        beforeEnter(to, from, next) {
          store.commit("message/setError", null);
          store.commit("message/setSuccess", null);
          next();
        },
      },
    ],
  },
  {
    path: "/home",
    component: Home,
    children: [
      {
        path: '/menu',
        name: 'menu',
        components: {
          menu: Menu
        }
      },
      {
        path: '/addrecipe',
        name: 'addrecipe',
        components: {
          addrecipe: AddRecipe
        }
      },
      {
        path: '/listrecipe',
        name: 'listrecipe',
        components: {
          listrecipe: ListRecipe
        }
      },
    ],
    beforeEnter: (to, from, next) => {
      return sessionStorage.getItem("Authorization")
        ? next()
        : next({ path: "/login" });
    },
  },
];
