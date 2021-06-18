import Home from "../components/Home/Home";
import Unauthorized from "../components/Unauthorized/Unauthorized";
import Login from "../components/Unauthorized/content/Login";

export const routes = [
  {
    path: "/",
    component: Unauthorized,
    children: [
      {
        path: "/login",
        component: Login,
      },
    ],
  },
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
