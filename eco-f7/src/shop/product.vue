<template>
  <f7-page>
    <f7-navbar :title="productInfo.name" back-link="Back"></f7-navbar>
    <f7-swiper pagination :params="{autoplay:{delay: 3000, disableOnInteraction:false}}">
      <f7-swiper-slide v-for="gallery in productInfo.gallery" :key="gallery.id">
        <img :src="gallery.image" width="100%" alt="product"/>
      </f7-swiper-slide>
    </f7-swiper>
    <f7-block-title>{{ productInfo.name }}</f7-block-title>
    <f7-block-title>Description:</f7-block-title>
    <f7-block>
      <p>{{ productInfo.description }}</p>
    </f7-block>
    <f7-block-title>Price:</f7-block-title>
    <f7-block>
      <p>{{ productInfo.price }} DZD</p>
    </f7-block>
    <f7-list inline-labels no-hairlines-md>
      <f7-list-input
              label="Quantity"
              type="select"
              :value="quantity"
              @input="quantity = $event.target.value"
      >
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </f7-list-input>
    </f7-list>

    <f7-block-title>Total Price :</f7-block-title>
    <f7-block>
      <h3 style="color: green"> {{ TotalPrice }} DZD</h3>
    </f7-block>

    <f7-toolbar position="bottom" class="toolbar-bottom-md">
      <f7-link
              @click="addToCart"
              class="add-to-cart"
              icon-ios="f7:cart_fill"
              icon-aurora="f7:cart_fill"
              icon-md="material:shopping_cart"
      >
        Add To Cart
      </f7-link>
    </f7-toolbar>
  </f7-page>
</template>

<script>
  import { mapGetters, mapActions} from 'vuex';

  export default {
    name: "product",
    data() {
      return {
        productInfo: {},
        quantity: 1,
      }
    },
    methods: {
      ...mapActions({
        ProductAndGalleryAction: 'shop/ProductAndGalleryAction',
        AddToMyCartAction: 'shop/AddToMyCartAction',
        CartAction: 'shop/CartAction'
      }),
      getProductInfo() {
        let productId = this.$f7route.params.productId;
        this.ProductAndGalleryAction(productId).then(() => {
          this.productInfo = this.$store.state.shop.productAndGallery;
        });
      },
      addToCart() {
        const app = this.$f7;

        if(!this.authenticated){
          return app.dialog.alert('Please Register Or Sign-in To Add The Product To Your Cart!');
        }

        app.dialog.confirm('Add This Product To Your Cart?', () => {

          let myProductInfo = {
            product_id: this.productInfo.id,
            product_name: this.productInfo.name,
            product_price: this.productInfo.price,
            quantity: this.quantity,
          };

          this.AddToMyCartAction(myProductInfo).then(() => {
            //Refresh the cart items
            this.CartAction();
            app.dialog.alert('Added To Your Cart!');
          });

        });
      },
    },
    computed: {
      ...mapGetters({
        authenticated : 'auth/authenticated'
      }),
      TotalPrice() {
        if (this.productInfo.price && this.quantity) {
          let total = this.productInfo.price * this.quantity;
          return total;
        }
        return 0;

      }
    },
    created() {
      this.getProductInfo();
    }
  }
</script>

<style scoped>

</style>