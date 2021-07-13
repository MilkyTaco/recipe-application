import axios from "axios";
const { api } = require("../../../config");

const message = {
 namespaced: true,
 state: () => ({
   recipes: {},
 }),
 getters: {
  
 },
 mutations: {
   SET_RECIPES(state, data){
    state.recipes = data
   }
 },
 actions: {
   async storeRecipe({commit}, data){
    const res = await axios.post(`${api}/recipe?token=${localStorage.getItem('token')}`, data).then(res => {
     return res
    }).catch(err => {
     return err.response
    })

    return res;
   },
   async getRecipe({commit}, data){
    const res = await axios.get(`${api}/recipe?token=${localStorage.getItem('token')}`, data).then(res => {
     commit('SET_RECIPES', res.data)
     return res
    }).catch(err => {
     return err.response
    })

    return res;
   },
   async deleteRecipe({commit}, id){
    const res = await axios.delete(`${api}/recipe/${id}?token=${localStorage.getItem('token')}`).then(res => {
     return res
    }).catch(err => {
     return err.response
    })

    return res;
   }
 },
};
export default message;
