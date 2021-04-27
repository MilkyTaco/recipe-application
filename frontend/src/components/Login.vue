<script>
export default {
  name: "Login",
  data() {
    return {
      form: { email: "", password: "" },
    };
  },
};
</script>
<template>
  <v-container>
    <v-row justify="center" align-content="center">
      <v-col align-self="center" sm="4">
        <v-card elevate="2" class="card-body">
          <v-form>
            <v-card-title>
              Login
            </v-card-title>
            <v-row justify-content="stretch" align-content="center">
              <v-col cols="12">
                <v-text-field
                  class="input-text"
                  v-model="form.email"
                  label="email"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  class="input-text"
                  v-model="form.password"
                  label="password"
                  type="password"
                />
              </v-col>
              <v-col cols="12" align-self="stretch">
                <v-btn class="login-button" type="submit" color="error"
                  >Login</v-btn
                >
              </v-col>
            </v-row>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<style lang="scss">
.login-button {
  width: 100%;
}
.card-body {
  padding: 7px;
}
.input-text {
  margin: 0px;
}
</style>
