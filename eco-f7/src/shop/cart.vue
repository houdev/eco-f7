<template>
  <div>
    <f7-card v-if="!authenticated" content="Please Sign-in To View Your Cart" ></f7-card>
    <template v-if="carTotal.total">
      <f7-list>
        <f7-list-item v-for="productCart in myCart" :key="productCart.id">
          {{ productCart.product_name }}
          <span style="color: green">
            X{{ productCart.quantity }}
          </span>
          <span style="color: red">
          {{ productCart.product_price }} DZD
          </span>
          <f7-button fill round color="red" @click="deleteFromMyCart(productCart.id)"><f7-icon material="delete_forever" ></f7-icon></f7-button>
        </f7-list-item>
      </f7-list>

      <f7-block>
        <f7-card>
          <f7-card-footer>
            <p>
              <b>Total:</b>
              <span style="color: green">
                {{ carTotal.total }} DZD
              </span>
            </p>
            <span>
              <f7-link v-if="carTotal.total != 0" href="/checkout/">checkout</f7-link>
            </span>
          </f7-card-footer>
        </f7-card>
      </f7-block>
    </template>
    <template v-if="authenticated && !carTotal.total">
      <f7-card content="Your Cart Is Empty!"></f7-card>
    </template>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
    export default {
      name: "cart",
      data(){
        return{
          myCart: {}
        }
      },
      methods:{
        ...mapActions({
          CartAction: 'shop/CartAction',
          MyCartTotalAction: 'shop/MyCartTotalAction',
          DeleteFromMyCartAction: 'shop/DeleteFromMyCartAction'
        }),
        getMyCart(){
          this.CartAction().then(() =>{
            this.myCart = this.$store.state.shop.myCart;
          })
          //Get cart total
          this.MyCartTotalAction()
        },
        deleteFromMyCart(id){
          const app = this.$f7;
          app.dialog.confirm("Remove This Product From Your Cart?", () => {

            this.DeleteFromMyCartAction(id).then(() =>{
              //Refresh the cart items
              this.CartAction();
              app.dialog.alert('Removed From Your Cart!');
            });

          });
        }
      },
      watch:{
        '$store.state.auth.user'(){
            this.getMyCart();
        },

        '$store.state.shop.myCart'(value){
          //Watch and update myCart
          this.myCart = value;
          this.MyCartTotalAction()
        }
      },
      computed:{
        ...mapGetters({
          authenticated: 'auth/authenticated',
          myCartTotal: 'shop/myCartTotal'
        }),
        carTotal(){
          if(this.myCartTotal){
            return this.myCartTotal
          }
          return 0
        }
      }
    }
</script>

<style scoped>

</style>