<template>
  <f7-page>
    <f7-navbar title="Categories" back-link></f7-navbar>
    <f7-row no-gap>
      <f7-col width="100" v-for="category in categories" v-bind:key="category.id">
        <f7-card>
          <f7-card-content>
            <p>{{ category.name }}</p>
            <img :src="category.cover" width="100%" @click="openCategoryProducts(category.id)"/>
          </f7-card-content>
        </f7-card>
      </f7-col>
    </f7-row>
  </f7-page>
</template>

<script>
  import {mapActions} from "vuex";

  export default {
    name: "ViewCategories",
    data() {
      return {
        categories: {},
      }
    },
    methods: {
      openCategoryProducts(categoryID) {
        this.$f7router.navigate(`/categories/category/${categoryID}`)
      },
      ...mapActions({
        CategoriesAction: 'shop/CategoriesAction',
      }),
      getCategories() {
        this.CategoriesAction().then(() => {
          this.categories = this.$store.state.shop.categories;
        });
      },
    },
    created() {
      this.getCategories()
    },
  }
</script>

<style scoped>

</style>