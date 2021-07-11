<script>
export default {
  name: "Home",
  methods: {
    isSelectedRoute(text) {
      return text === this.$route.fullPath.split("/")[2];
    },
  },
};
</script>
<template>
  <v-container fluid class="pa-0 ma-0 main-container">
    <v-container fluid class="sub-container pa-0 ma-0">
      <v-app-bar color="black">
        <v-container fluid class="pa-1">
          <v-row justify="center" align="center">
            <v-col cols="12" sm="10" md="8" align="center">
              <v-row justify="space-between" align="center">
                <v-col cols="2">
                  <router-link
                    to="/home/community"
                    class="white--text text-decoration-none"
                  >
                    <span
                      :class="
                        `body-2 hidden-sm-and-down font-weight-bold text-uppercase ${
                          isSelectedRoute('community') ? 'warning--text' : ''
                        }`
                      "
                    >
                      Community
                    </span>
                    <v-tooltip class="hidden-md-and-up" bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="hidden-md-and-up"
                          :color="
                            isSelectedRoute('community') ? 'warning' : 'white'
                          "
                          medium
                          v-bind="attrs"
                          v-on="on"
                        >
                          mdi-web
                        </v-icon>
                      </template>
                      <span>Community</span>
                    </v-tooltip>
                  </router-link>
                </v-col>
                <v-col cols="2">
                  <router-link
                    to="/home/account"
                    class="white--text text-decoration-none"
                  >
                    <span
                      :class="
                        `body-2 hidden-sm-and-down font-weight-bold text-uppercase ${
                          isSelectedRoute('account') ? 'warning--text' : ''
                        }`
                      "
                    >
                      Account
                    </span>
                    <v-tooltip class="hidden-md-and-up" bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="hidden-md-and-up"
                          :color="
                            isSelectedRoute('account') ? 'warning' : 'white'
                          "
                          medium
                          v-bind="attrs"
                          v-on="on"
                        >
                          mdi-account
                        </v-icon>
                      </template>
                      <span>Account</span>
                    </v-tooltip>
                  </router-link>
                </v-col>
                <v-col cols="4">
                  <v-img
                    src="../../assets/images/logo.png"
                    max-width="150"
                    class="mb-n10 rounded-circle"
                    elevation="5"
                  />
                </v-col>
                <v-col cols="2">
                  <router-link
                    to="/home/categories"
                    class="white--text text-decoration-none"
                  >
                    <span
                      :class="
                        `body-2 hidden-sm-and-down font-weight-bold text-uppercase ${
                          isSelectedRoute('categories') ? 'warning--text' : ''
                        }`
                      "
                    >
                      Categories
                    </span>
                    <v-tooltip class="hidden-md-and-up" bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="hidden-md-and-up"
                          :color="
                            isSelectedRoute('categories') ? 'warning' : 'white'
                          "
                          medium
                          v-bind="attrs"
                          v-on="on"
                        >
                          mdi-clipboard-list-outline
                        </v-icon>
                      </template>
                      <span>Categories</span>
                    </v-tooltip>
                  </router-link>
                </v-col>
                <v-col cols="2">
                  <router-link
                    to="/home/recipes"
                    class="white--text text-decoration-none"
                  >
                    <span
                      :class="
                        `body-2 hidden-sm-and-down font-weight-bold text-uppercase ${
                          isSelectedRoute('recipes') ? 'warning--text' : ''
                        }`
                      "
                    >
                      Recipes
                    </span>
                    <v-tooltip class="hidden-md-and-up" bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="hidden-md-and-up"
                          :color="
                            isSelectedRoute('recipes') ? 'warning' : 'white'
                          "
                          medium
                          v-bind="attrs"
                          v-on="on"
                        >
                          mdi-food
                        </v-icon>
                      </template>
                      <span>Recipes</span>
                    </v-tooltip>
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
<style lang="scss" scoped></style>
