<script>
export default {
  name: "Login",
  data() {
    return {
      form: { email: "", password: "" },
    };
  },
  computed: {
    getLoginError() {
      return this.$store.getters["message/getError"];
    },
  },
  methods: {
    async handleSubmit(e) {
      e.preventDefault();
      this.$store.dispatch("user/Login", this.form);
    },
  },
};
</script>
<template>
  <v-container fluid class="mt-10">
    <v-row justify="center" align="center">
      <v-col col="10" sm="6" md="3">
        <v-card outlined class="ma-2 pa-5 pt-7 pb-7" dark>
          <v-form ref="form" @submit="handleSubmit">
            <v-row justify="center" align="start">
              <v-col cols="12">
                <v-row justify="center">
                  <v-card-title class="warning--text text-center">
                    LOGIN
                  </v-card-title>
                </v-row>
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-text-field
                  rounded
                  outlined
                  append-icon="mdi-email"
                  v-model="form.email"
                  label="email"
                  type="email"
                />
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-text-field
                  rounded
                  outlined
                  append-icon="mdi-lock"
                  v-model="form.password"
                  label="password"
                  type="password"
                />
              </v-col>
              <v-col cols="12" align-self="stretch">
                <v-btn
                  type="submit"
                  rounded
                  block
                  elevation="0"
                  color="warning"
                >
                  Login
                </v-btn>
              </v-col>
              <v-col align-self="center" v-if="getLoginError">
                <p>{{ getLoginError }}</p>
              </v-col>
            </v-row>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
