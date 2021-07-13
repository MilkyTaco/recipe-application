import Vuex from "vuex";
import Vue from "vue";
import message from "./content/message_store";
import category from "./content/category";
import user from "./content/user_store";
import recipe from "./content/recipe";


Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    message,
    user,
    category,
    recipe
  },
});

export default store;
