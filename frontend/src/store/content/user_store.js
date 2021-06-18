import axios from "axios";
import { router } from "../../main";

const user = {
  namespaced: true,
  state: () => ({
    profile: null,
    loading: {
      profile: false,
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
        const { data } = await axios.post("/api/user/login", form);
        sessionStorage.setItem("Authorization", `Bearer  ${data.token}`);
        commit("setLoading", { loading: false, type: "login" });
        return router.push("/home");
      } catch (error) {
        const { message } = error.response.data || error;
        commit("setLoading", { loading: false, type: "login" });
        return commit("message/setError", message, { root: true });
      }
    },
  },
};

export default user;
