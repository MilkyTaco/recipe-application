import axios from "axios";
const { api } = require("../../../config");

const recipe = {
  namespaced: true,
  state: () => ({
    recipes: [],
    recipe: null,
    loading: {
      recipes: false,
      recipe: false,
      delete: false,
    },
  }),
  getters: {
    getAllRecipes: (state) => state.recipes,
    getRecipe: (state) => state.recipe,
    getLoading: (state) => state.loading,
  },
  mutations: {
    setAllRecipes: (state, recipes) => (state.recipes = [...recipes]),
    setRecipe: (state, recipe) => (state.recipe = { ...recipe }),
    setLoading: (state, { type, loading }) => (state.loading[type] = loading),
  },
  actions: {
    AllRecipes: async ({ commit, state }) => {
      if (!state.recipes[0])
        commit("setLoading", { loading: true, type: "recipes" });
      try {
        const { data } = await axios.get(`${api}/recipe/show/all`, {
          headers: { Authorization: sessionStorage.getItem("Authorization") },
        });
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
    RecipeInfo: async ({ commit }, id) => {
      commit("setLoading", { loading: true, type: "recipe" });
      try {
        const { data } = await axios.get(`${api}/recipe/view/id=${id}`, {
          headers: { Authorization: sessionStorage.getItem("Authorization") },
        });
        commit("setLoading", { loading: false, type: "recipe" });
        return commit("setRecipe", data);
      } catch (error) {
        const message = error.response.data.errors || error;
        commit("setLoading", { loading: false, type: "recipe" });
        return commit(
          "message/setError",
          JSON.stringify(message).replace(/\W/gi, " "),
          {
            root: true,
          }
        );
      }
    },
    Delete: async ({ commit }, id) => {
      commit("setLoading", { loading: true, type: "delete" });
      try {
        await axios.post(`${api}/recipe/delete/id=${id}`, {
          headers: { Authorization: sessionStorage.getItem("Authorization") },
        });
        return commit("setLoading", { loading: false, type: "delete" });
      } catch (error) {
        const message = error.response.data.errors || error;
        commit("setLoading", { loading: false, type: "delete" });
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
