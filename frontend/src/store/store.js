import Vuex from "vuex";
import Vue from "vue";
import message from "./content/message_store";
import user from "./content/user_store";
import recipe from "./content/recipe_store";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    message,
    user,
    recipe,
  },
});

export default store;
