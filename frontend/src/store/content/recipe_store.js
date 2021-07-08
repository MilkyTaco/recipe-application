import axios from "axios";
const { api } = require("../../../config");

const recipe = {
  usespaced: true,
  state: () => ({
    recipes: [],
    loading: {
      recipes: false,
    },
  }),
  getters: {
    getAllRecipes: (state) => state.recipes,
    getLoading: (state) => state.loading,
  },
  mutations: {
    setAllRecipes: (state, recipes) => (state.recipes = [...recipes]),
    setLoading: (state, { type, loading }) => (state[type].loading = loading),
  },
  actions: {
    AllRecipes: async ({ commit, state }) => {
      if (!state.recipes[0])
        commit("setLoading", { loading: true, type: "recipes" });
      try {
        const { data } = await axios.get(`${api}/recipe/show/all`);
        commit("setLoading", { loading: false, type: "recipes" });
        return commit("setAllRecipes", data);
      } catch (error) {
        const message = error.response.data.errors || error;
        commit("setLoading", { loading: false, type: "recipes" });
        return commit(
          "message/setError",
          JSON.stringify(message).replace(/\W/gi, " "),
          {
            root: true,
          }
        );
      }
    },
  },
};

export default recipe;
