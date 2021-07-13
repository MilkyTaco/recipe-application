<script>
export default {
    name: "Home"
};
</script>
<template lang="">
  <v-container fluid class="pa-0 ma-0 main-container">
    <v-container fluid class="sub-container pa-0 ma-0">
      <div class="navigation">
        <router-link to="/home">Home</router-link>
        <router-link to="/users">Users</router-link>
        <img  src="../../assets/images/logo.png" class="img-fluid">
        <router-link to="/categories">Categories</router-link>
        <router-link to="/menu">Recipes</router-link>
      </div>
      <v-container fluid class="pa-0 ma-0 mt-10">
        <router-view name="menu"></router-view>
        <router-view name="listrecipe"></router-view>
        <router-view name="addrecipe"></router-view>
      </v-container>
    </v-container>
  </v-container>
</template>
<style lang="scss">
.navigation {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 64px;
  background: #000;
  display: flex;
  justify-content:center;
  align-items: center;
  z-index: 3;
}

.navigation img {
  background-position: center;
  background-attachment: fixed;
  background-size: cover;
  border-radius: 50%;
  margin-top: 30px;
}

.navigation a{
  color: rgb(202, 202, 202) !important;
  text-decoration: none;
  text-transform: uppercase;
  padding: 0px 3rem;
  transition: all 250ms ease-in-out;
}

.navigation a.router-link-active {
  color: white !important;
}

.navigation a:hover {
  color: rgb(156, 156, 156) !important;
}
</style>
