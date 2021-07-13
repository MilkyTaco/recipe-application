import axios from "axios";
const { api } = require("../../../config");

const message = {
 namespaced: true,
 state: () => ({
   categories: {},
 }),
 getters: {
  
 },
 mutations: {
   SET_CATEGORIES(state, data){
    state.categories = data
   }
 },
 actions: {
   async getCategories({commit}){
    await axios.get(`${api}/categories`).then(res => {
     commit('SET_CATEGORIES', res.data)
     return res
    }).catch(err => {
     return err.response
    })
   }
 },
};
export default message;
