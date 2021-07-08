import Home from "../components/Home/Home";
import Community from "../components/Home/content/Community";

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
    beforeEnter: (to, from, next) => {
      return sessionStorage.getItem("Authorization")
        ? next()
        : next({ path: "/login" });
    },
    children: [
      {
        path: "community",
        component: Community,
      },
    ],
  },
];
