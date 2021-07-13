import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import { routes } from "./routes/routes";
import store from "./store/store";
import VueRouter from "vue-router";
import Toast from "vue-toastification";
import VueFileAgent from 'vue-file-agent';
import 'vue-file-agent/dist/vue-file-agent.css';
import "vue-toastification/dist/index.css";
Vue.use(VueFileAgent);
Vue.config.productionTip = false;
Vue.use(VueRouter);

Vue.use(Toast, {
  transition: "Vue-Toastification__bounce",
  maxToasts: 3,
  position: "top-right",
  hideProgressBar: true,
});

export const router = new VueRouter({
  routes,
  mode: "history",
});

new Vue({
  vuetify,
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
