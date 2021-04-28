import Home from "../../components/Home";
import Login from "../../components/Login";

export const routes = [
  { path: "/", component: Login },
  {
    path: "/home",
    component: Home,
    beforeEnter: (to, from, next) => {
      return sessionStorage.getItem("Authorization") ? next() : next({ path: "/" });
    },
  },
];
