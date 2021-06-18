import Home from "../components/Home/Home";
import Login from "../components/Unauthorized/Login";

export const routes = [
  { path: "/", component: Login },
  {
    path: "/home",
    component: Home,
    beforeEnter: (to, from, next) => {
      return sessionStorage.getItem("Authorization")
        ? next()
        : next({ path: "/" });
    },
  },
];
