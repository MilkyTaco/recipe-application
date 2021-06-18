<script>
export default {
  name: "App",
};
</script>
<template>
  <v-app>
    <v-main class="main-container">
      <v-container fluid class="sub-container pa-0 ma-0">
        <transition name="fade" mode="out-in">
          <router-view> </router-view>
        </transition>
      </v-container>
    </v-main>
  </v-app>
</template>

<style lang="css">
@import "./assets/css/styles.css";
</style>
