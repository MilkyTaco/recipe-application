import Home from "../../components/Home";
import Login from "../../components/Login";
import Register from "../../components/Register";
import Recipes from "../../components/children/Recipes";

export const routes = [
  { path: "/", component: Login },
  { path: "/signup", component: Register },
  {
    path: "/home",
    component: Home,
    children: [{ path: "/home/recipes", component: Recipes }],
    beforeEnter: (to, from, next) => {
      return sessionStorage.getItem("token") ? next() : next({ path: "/" });
    },
  },
];
