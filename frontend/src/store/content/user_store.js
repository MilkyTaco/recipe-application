import axios from "axios";
import { router } from "../../main";
const { api } = require("../../../config");

const user = {
  namespaced: true,
  state: () => ({
    profile: null,
    loading: {
      profile: false,
      signup: false,
      login: false,
    },
  }),
  getters: {
    getLoading: (state) => state.loading,
    getProfile: (state) => state.profile,
  },
  mutations: {
    setLoading: (state, { type, loading }) => (state.loading[type] = loading),
    setProfile: (state, profile) => (state.profile = profile),
  },
  actions: {
    Login: async ({ commit, dispatch }, form) => {
      dispatch("message/defaultState", null, { root: true });
      commit("setLoading", { loading: true, type: "login" });
      try {
        const { data } = await axios.post(`${api}/user/login`, form);
        sessionStorage.setItem("Authorization", `Bearer  ${data.token}`);
        localStorage.setItem("token", data.token);
        commit("setLoading", { loading: false, type: "login" });
        return router.push("/home");
      } catch (error) {
        const { message } = error.response.data.errors || error;
        commit("setLoading", { loading: false, type: "login" });
        return commit("message/setError", message, { root: true });
      }
    },
    Signup: async ({ commit, dispatch }, form) => {
      dispatch("message/defaultState", null, { root: true });
      commit("setLoading", { loading: true, type: "signup" });
      try {
        const { data } = await axios.post(`${api}/user/signup`, form);
        sessionStorage.setItem("Authorization", `Bearer  ${data.token}`);
        commit("setLoading", { loading: false, type: "signup" });
        return router.push("/home");
      } catch (error) {
        const message = error.response.data.errors || error;
        commit("setLoading", { loading: false, type: "signup" });
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

export default user;
