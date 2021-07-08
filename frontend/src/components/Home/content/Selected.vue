<script>
export default {
  name: "Selected",
  computed: {
    getRecipeLoading() {
      return this.$store.getters["recipe/getLoading"];
    },
    recipe() {
      return this.$store.getters["recipe/getRecipe"];
    },
  },
  created() {
    this.$store.dispatch("recipe/RecipeInfo", this.$route.params.id);
  },
};
</script>
<template>
  <v-container fluid class="mt-16">
    <v-row justify="center" align="center">
      <v-col cols="12" md="7" v-if="!getRecipeLoading.recipe">
        <v-sheet
          class="pa-7 pa-sm-12 pa-md-12"
          elevation="2"
          color="grey lighten-3"
        >
          <v-row justify="space-between">
            <v-col cols="4" sm="4" md="4">
              <v-row justify="start">
                <v-col cols="12" align="start">
                  <span class="text-capitalize">
                    {{ `Name: ${recipe.title}` }}
                  </span>
                </v-col>
                <v-col cols="12">
                  <span>Description:</span>
                </v-col>
                <v-col cols="12" class="pt-1">
                  <span>{{ recipe.description }}</span>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-row justify="start">
                <v-col cols="12" align="start">
                  <span v-if="recipe.ingredients[0]" class="text-capitalize">
                    Ingredients:
                  </span>
                  <span
                    v-else
                    class="text-capitalize font-weight-bold error--text"
                  >
                    No Ingredients listed
                  </span>
                </v-col>
                <v-col cols="12" class="pt-1">
                  <ul class="text-decoration-none">
                    <li
                      v-for="ingredient in recipe.ingredients"
                      :key="ingredient.id"
                    >
                      <span class="body-1">
                        {{
                          `${ingredient.amount} ${ingredient.measuring_instrument} of`
                        }}
                      </span>
                      <span class="body-1 font-weight-bold ">
                        {{ ingredient.name }}
                      </span>
                    </li>
                  </ul>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-row justify="start">
                <v-col cols="12" align="start">
                  <span v-if="recipe.procedures[0]" class="text-capitalize">
                    Procedures:
                  </span>
                  <span
                    v-else
                    class="text-capitalize font-weight-bold error--text"
                  >
                    No Procedures listed
                  </span>
                </v-col>
                <v-col cols="12" class="pt-1">
                  <li
                    v-for="procedure in recipe.procedures"
                    :key="procedure.id"
                  >
                    <span> Step {{ procedure.step_count }}: </span>
                    <span> {{ procedure.description }}: </span>
                    <span> Duration {{ procedure.duration }}: </span>
                  </li>
                </v-col>
              </v-row>
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
      <v-col cols="12" md="7" v-else>
        <v-skeleton-loader type="article, article, actions" />
      </v-col>
    </v-row>
  </v-container>
</template>
