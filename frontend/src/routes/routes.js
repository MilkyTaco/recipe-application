import Home from "../components/Home/Home";
import Community from "../components/Home/content/Community";
import Selected from "../components/Home/content/Selected";
import Account from "../components/Home/content/Account";

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
    beforeEnter: (to, from, next) => {
      sessionStorage.clear();
      next();
    },
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
    beforeEnter: async (to, from, next) => {
      if (sessionStorage.getItem("Authorization")) {
        await store.dispatch("user/Profile");
        if (store.getters["user/getProfile"]) return next();
        return next({ path: "/unauth/login" });
      }
      return next({ path: "/unauth/login" });
    },
    children: [
      {
        path: "community",
        component: Community,
      },
      {
        path: "account",
        component: Account,
      },
      {
        path: "selected/:id",
        component: Selected,
      },
    ],
  },
];
