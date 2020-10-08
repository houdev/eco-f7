<template>
  <f7-page>
    <f7-navbar title="Category" back-link></f7-navbar>

    <f7-row no-gap>
      <f7-col width="50" v-for="product in products" :key="product.id">
        <f7-card>
          <f7-card-content>
            <p>{{ product.name }}</p>
            <img :src="product.thumbnail" width="100%"/>
          </f7-card-content>
          <f7-card-footer class="no-border">
            <f7-button fill @click="openProduct(product.id)">Buy</f7-button>
            <f7-link color="red">{{ product.price }} DZD</f7-link>
          </f7-card-footer>
        </f7-card>
      </f7-col>
    </f7-row>

  </f7-page>
</template>

<script>
  import {mapActions} from 'vuex'

  export default {
    name: "CategoryProducts",
    data() {
      return {
        products: {}
      }
    },
    methods: {
      ...mapActions({
        CategoryProductsAction: 'shop/CategoryProductsAction'
      }),
      getCategoryProducts(categoryID) {
        this.CategoryProductsAction(categoryID).then(() => {
          this.products = this.$store.state.shop.categoryProducts;
        })
      },
      openProduct(productID) {
        this.$f7router.navigate(`/Product/${productID}`)
      },
    },
    created() {
      let categoryID = this.$f7route.params.categoryID;
      this.getCategoryProducts(categoryID);

    }
  }
</script>

<style scoped>

</style>