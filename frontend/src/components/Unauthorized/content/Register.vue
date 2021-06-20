<script>
export default {
  name: "Register",
  data: () => ({
    form: {
      name: "",
      email: "",
      password: "",
    },
  }),
};
</script>
<template>
  <v-container fluid class="mt-10">
    <v-row justify="center" align="center">
      <v-col col="10" sm="6" md="3">
        <v-card dark class="ma-2 pa-5 pt-7 pb-7 rounded-xl">
          <v-form ref="form">
            <v-row justify="center" align="start">
              <v-col cols="12">
                <v-row justify="center">
                  <v-card-title class="warning--text text-center">
                    SIGNUP
                  </v-card-title>
                </v-row>
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-text-field
                  rounded
                  outlined
                  autofocus
                  append-icon="mdi-text"
                  v-model="form.email"
                  label="Name"
                  type="text"
                />
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-text-field
                  rounded
                  outlined
                  autofocus
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
              <v-col v-if="false" class="pa-1">
                <v-alert class="alert pt-2 pb-2" type="error"> </v-alert>
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-btn
                  type="submit"
                  rounded
                  block
                  elevation="0"
                  color="warning"
                >
                  Confirm
                </v-btn>
              </v-col>
            </v-row>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
