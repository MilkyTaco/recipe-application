<script>
export default {
  name: "App",
};
</script>
<template>
  <v-app>
    <v-main class="main-container">
      <v-container fluid class="sub-container">
        <router-view> </router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<style lang="css">
@import "./assets/css/styles.css";
</style>
