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
  methods: {
    isOwned(user_id) {
      this.$store.getters["user/getProfile"].id === user_id;
    },
    fixTime(time) {
      const new_time = new Date(time);
      return `${new_time.getDate()}-${new_time.getMonth()}-${new_time.getFullYear()}`;
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
                  <span class="text-capitalize text-md-h5 text-sm-h6">
                    {{ recipe.title }}
                  </span>
                </v-col>
                <v-col cols="12" class="pt-0 pb-0 body-2 font-weight-bold">
                  <v-chip
                    min-width="100"
                    small
                    color="primary"
                    class="text-capitalize"
                  >
                    {{ recipe.categories.name }}
                  </v-chip>
                </v-col>
                <v-col cols="12" class="pb-2">
                  <v-divider />
                </v-col>
                <v-col cols="12" class="pt-0">
                  <span class="secondary--text">{{ recipe.description }}</span>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-row justify="start">
                <v-col cols="12" align="start">
                  <span v-if="recipe.ingredients[0]" class="text-capitalize">
                    Ingredients
                  </span>
                  <span
                    v-else
                    class="text-capitalize font-weight-bold error--text"
                  >
                    No Ingredients listed
                  </span>
                  <v-btn
                    class="ml-1"
                    icon
                    color="primary"
                    v-if="isOwned(recipe.users.id)"
                  >
                    <v-icon>mdi-plus </v-icon>
                  </v-btn>
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
                    Procedures
                  </span>
                  <span
                    v-else
                    class="text-capitalize font-weight-bold error--text"
                  >
                    No Procedures listed
                  </span>
                  <v-btn
                    class="ml-1"
                    icon
                    color="primary"
                    v-if="isOwned(recipe.users.id)"
                  >
                    <v-icon>mdi-plus </v-icon>
                  </v-btn>
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
            <v-col cols="12" class="pb-1 pt-1">
              <v-divider />
            </v-col>
            <v-col cols="12" class="pt-2 pb-0">
              <span class="text-capitalize body-2 font-weight-bold">
                {{ `created by @${recipe.users.name}` }}
              </span>
            </v-col>
            <v-col cols="12" class="pt-0 pb-0 mt-n1">
              <span class="caption">
                {{ fixTime(recipe.created_at) }}
              </span>
            </v-col>
          </v-row>
          <v-row class="mt-3" justify="start" v-if="isOwned(recipe.users.id)">
            <v-col cols="12" md="6">
              <v-btn color="warning" block min-width="120">
                <v-icon left> mdi-delete </v-icon>
                Delete
              </v-btn>
            </v-col>
            <v-col cols="12" md="6">
              <v-btn color="primary" block min-width="120">
                <v-icon left> mdi-content-save</v-icon>
                Update
              </v-btn>
            </v-col>
          </v-row>
        </v-sheet>
      </v-col>
      <v-col cols="12" md="7" v-else>
        <v-skeleton-loader type="article, article, actions" />
      </v-col>
    </v-row>
  </v-container>
</template>
