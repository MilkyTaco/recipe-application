import Vuex from "vuex";
import Vue from "vue";
import message from "./content/message_store";
import user from "./content/user_store";

Vue.use(Vuex);

const store = new Vuex.store({
  message,
  user,
});

export default store;
