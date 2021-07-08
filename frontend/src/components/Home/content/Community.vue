<script>
export default {
  name: "Community",
  data: () => ({
    loaders: [1, 2, 3, 4],
  }),
  computed: {
    getRecipeLoading() {
      return this.$store.getters["recipe/getLoading"];
    },
    getAllRecipes() {
      return this.$store.getters["recipe/getAllRecipes"];
    },
  },
  methods: {
    fixTime(time) {
      const new_time = new Date(time);
      return `${new_time.getDate()}-${new_time.getMonth()}-${new_time.getFullYear()}`;
    },
  },
  created() {
    this.$store.dispatch("recipe/AllRecipes");
  },
};
</script>
<template>
  <v-container fluid class="mt-10">
    <v-row
      justify="center"
      justify-sm="center"
      justify-md="start"
      v-if="!getRecipeLoading.recipes"
    >
      <v-col
        cols="11"
        sm="5"
        md="4"
        v-for="recipe in getAllRecipes"
        :key="recipe.id"
      >
        <v-card class="mx-auto my-12" max-width="374">
          <v-card-title>
            <span>{{ recipe.title }} </span>
          </v-card-title>
          <v-card-subtitle class="pt-1">
            <v-icon color="secondary" small>
              mdi-web
            </v-icon>
            <span
              class="caption font-weight-bold primary--text text-capitalize ml-1"
            >
              {{ recipe.users.name }}
            </span>
            &bull;
            <span class="caption font-weight-bold">
              {{ fixTime(recipe.created_at) }}
            </span>
          </v-card-subtitle>

          <v-card-text>
            <v-row align="center" class="mx-0">
              <v-container fluid class="pl-0 text-lowercase">
                <div>
                  Description:
                  {{ recipe.description }}
                </div>
              </v-container>
            </v-row>
            <v-divider class="mt-2 mb-2" />
            <v-row align="center" class="mx-0">
              <v-container fluid class="pl-0 text-lowercase">
                <div v-if="recipe.ingredients[0]">
                  Ingredients:
                  <ul>
                    <li
                      v-for="ingredient in recipe.ingredients"
                      :key="ingredient.id"
                    >
                      <span class="caption">
                        {{
                          `${ingredient.amount} ${ingredient.measuring_instrument} of`
                        }}
                      </span>
                      <span class="caption font-weight-bold">
                        {{ ingredient.name }}
                      </span>
                    </li>
                  </ul>
                </div>
                <div v-else class="caption font-weight-bold">
                  No listed ingredients
                </div>
              </v-container>
            </v-row>
          </v-card-text>

          <v-divider class="mx-4"></v-divider>

          <v-card-actions>
            <v-btn color="warning" text>
              View more
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-row justify="start" v-else>
      <v-col v-for="loader in loaders" :key="loader">
        <v-skeleton-loader
          class="mx-auto"
          max-width="300"
          min-width="270"
          type="card"
        />
      </v-col>
    </v-row>
  </v-container>
</template>
