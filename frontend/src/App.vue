<script>
export default {
  name: "App",
};
</script>
<template>
  <v-app>
    <v-main>
      <transition name="fade" mode="out-in">
        <router-view> </router-view>
      </transition>
    </v-main>
  </v-app>
</template>
<style lang="css">
@import "./assets/css/styles.css";
</style>
