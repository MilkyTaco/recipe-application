import Home from "../components/Home/Home";
import Unauthorized from "../components/Unauthorized/Unauthorized";
import Login from "../components/Unauthorized/content/Login";
import Register from "../components/Unauthorized/content/Register";
import Landing from "../components/Landing/Landing";

export const routes = [
  { path: "/", component: Landing },
  {
    path: "/unauth",
    component: Unauthorized,
    children: [
      {
        path: "login",
        component: Login,
      },
      {
        path: "signup",
        component: Register,
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
  },
];
