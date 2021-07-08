<script>
export default {
  name: "Landing",
  mounted() {
    setTimeout(
      () =>
        !sessionStorage.getItem("Authorization")
          ? this.$router.replace("/unauth/login")
          : this.$router.replace("/home/community"),
      3000
    );
  },
};
</script>
<template>
  <v-container fluid class="pa-0 ma-0 landing-container">
    <v-container fluid class="landing-sub-container pa-0 ma-0">
      <v-row justify="center" align="center">
        <v-img
          src="../../assets/images/logo_353.png"
          max-width="300"
          class="rounded-circle"
        />
      </v-row>
    </v-container>
  </v-container>
</template>
<style lang="css">
@import "../../assets/css/styles.css";
</style>
