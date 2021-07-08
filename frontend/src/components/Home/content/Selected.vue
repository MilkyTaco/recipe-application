<script>
export default {
  name: "Selected",
};
</script>
<template>
  <v-container fluid class="mt-16">
    <v-row justify="center" align="center">
      <v-col cols="12" md="7" v-if="false">
        <v-sheet
          class="pa-5 pa-sm-10 pa-md-12"
          elevation="2"
          color="grey lighten-3"
        >
          <v-row justify="space-between">
            <v-col cols="4" sm="4" md="4">
              <v-row justify="start">
                <v-col cols="12" align="start">
                  <span>Name:</span>
                </v-col>
                <v-col cols="12">
                  <span>Description:</span>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <span>Ingredients:</span>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <span>Procedures:</span>
            </v-col>
          </v-row>
          <v-row justify="center">
            <v-btn
              color="warning"
              class="mt-10"
              width="50%"
              max-width="200"
              min-width="120"
              rounded
            >
              <v-icon left> mdi-delete </v-icon>
              Delete
            </v-btn>
          </v-row>
        </v-sheet>
      </v-col>
      <v-col cols="12" md="7">
        <v-skeleton-loader v-bind="attrs" type="article, article, actions" />
      </v-col>
    </v-row>
  </v-container>
</template>
