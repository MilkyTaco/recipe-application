<script>
export default {
  name: "Unauthorized",
};
</script>
<template>
  <v-container fluid class="pa-0 ma-0 main-container">
    <v-container fluid class="sub-container pa-0 ma-0">
      <v-app-bar color="black">
        <v-container fluid class="pa-1">
          <v-row justify="center" align="center">
            <v-col cols="12" sm="6" md="5" align="center">
              <v-row justify="space-between" align="center">
                <v-col cols="3">
                  <router-link
                    to="/unauth/login"
                    class="white--text text-decoration-none font-weight-bold"
                  >
                    LOGIN
                  </router-link>
                </v-col>
                <v-col cols="5">
                  <v-img
                    src="../../assets/images/logo.png"
                    max-width="150"
                    class="mb-n10 rounded-circle"
                    elevation="5"
                  />
                </v-col>
                <v-col cols="3">
                  <router-link
                    to="/unauth/signup"
                    class="white--text text-decoration-none font-weight-bold"
                  >
                    SIGNUP
                  </router-link>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-container>
      </v-app-bar>
      <v-container fluid class="pa-0 ma-0 mt-10">
        <router-view></router-view>
      </v-container>
    </v-container>
  </v-container>
</template>

<style lang="css">
@import "../../assets/css/styles.css";
</style>
