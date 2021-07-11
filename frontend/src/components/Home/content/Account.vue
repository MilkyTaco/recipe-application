<script>
export default {
  name: "Account",
  data: () => ({
    form: null,
    rules: [(e) => !!e || "this field is required"],
  }),
  computed: {
    getUserLoading() {
      return this.$store.getters["user/getLoading"];
    },
    user() {
      return this.$store.getters["user/getProfile"];
    },
  },
  created() {
    this.form = JSON.parse(JSON.stringify(this.user));
  },
};
</script>
<template>
  <v-container fluid>
    <v-row justify="center" v-if="!getUserLoading.profile">
      <v-col cols="12" md="7">
        <v-sheet
          class="pa-7 pa-sm-12 pa-md-12 ma-2 mt-10"
          elevation="2"
          color="grey lighten-3"
        >
          <v-row justify="start">
            <v-col cols="12">
              <v-form ref="form">
                <v-row justify="start">
                  <v-col cols="12" align="start">
                    <span class="body-1 primary--text">
                      <v-icon color="primary">mdi-information</v-icon>
                      Account Information
                    </span>
                  </v-col>
                  <v-col md="4" sm="5" align="start">
                    <v-text-field
                      outlined
                      dense
                      v-model="form.id"
                      label="ID"
                      :rules="rules"
                      readonly
                    />
                  </v-col>
                  <v-col md="8" sm="7" align="start">
                    <v-text-field
                      outlined
                      dense
                      v-model="form.name"
                      label="Name"
                      :rules="rules"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12" class="pt-0">
                    <v-text-field
                      outlined
                      dense
                      v-model="form.email"
                      label="Email"
                      :rules="rules"
                      readonly
                    />
                  </v-col>
                </v-row>
              </v-form>
            </v-col>
          </v-row>
        </v-sheet>
      </v-col>
    </v-row>
    <v-row justify="start" v-else>
      <v-col cols="12" md="7">
        <v-skeleton-loader
          class="mx-auto"
          max-width="300"
          min-width="270"
          type="article, article, actions"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped></style>
