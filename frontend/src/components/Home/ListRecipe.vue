<template>
 <div>
  <div class="container">
    <div class="row justify-content-center align-items-center mt-content" v-if="!showRecipe">
     <v-card
    class="mx-auto mt-4"
    style="cursor: pointer;"
    v-on:click="showRecipe = true; currentRecipe = rec"
    max-width="300" v-for="(rec, i) in recipes" :key="i">
     <v-img
       class="white--text align-end"
       height="200px"
       :src="'http://127.0.0.1:8000/uploads/'+rec.image">
       <div class="title">
        <h5>{{rec.title}}</h5>
       </div>
     </v-img>
    </v-card>
    </div>
    <div class="row justify-content-center align-items-center mt-content" v-else>
     <div class="addrecipe-card mb-5 mt-5">
       <v-btn
          elevation="1"
          class="mt-3"
          color="success"
          v-on:click.prevent="showRecipe = false"
        >Return</v-btn>
       <v-btn
          elevation="1"
          class="mt-3 ml-2"
          color="error"
          v-on:click.prevent="deleteRecipe"
        >Delete</v-btn>
      <h3 class="mt-5">Title: {{currentRecipe.title}}</h3>
      <h5>Description: {{currentRecipe.description}}</h5>
      <h3 class="mt-5">Content</h3>
      <div v-html="currentRecipe.content"></div>
     </div>
    </div>
  </div>
 </div>
</template>
<script>
import { mapState } from 'vuex';
export default {
 data(){
  return {
   showRecipe: false,
   currentRecipe: '',
  }
 },
 mounted(){
  this.getRecipe()
 },
 methods: {
  async getRecipe(){
    await this.$store.dispatch('recipe/getRecipe')
  },
  async deleteRecipe(){
   const res = await this.$store.dispatch('recipe/deleteRecipe', this.currentRecipe.id)
   if(res.status == 200){
    await this.$store.dispatch('recipe/getRecipe')
    this.$router.push('/listrecipe')
    this.showRecipe = false
    this.currentRecipe = ''
    this.$toast.success('Recipe deleted successfully')
   }
  }
 },
 computed: {
  ...mapState('recipe', ['recipes'])
 }
}
</script>
<style>
.title {
 position: absolute;
 bottom: 0;
 left: 0;
 background: #000;
 color: white;
 width: 100%;
 height: auto;
}

.title h5 {
 text-align: center;
}
</style>