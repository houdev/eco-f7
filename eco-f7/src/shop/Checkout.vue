<template>
  <f7-page>
    <f7-navbar title="Checkout" back-link></f7-navbar>
    <f7-block-title>Shipping Address</f7-block-title>
    <f7-list form id="checkoutForm">
      <f7-list-item>
        <f7-label>Address</f7-label>
        <f7-input
                name="address"
                type="text"
                placeholder="Address"
                :value="shippingAddress"
                @input="shippingAddress = $event.target.value"
        >
        </f7-input>
      </f7-list-item>
    </f7-list>
    <f7-block-title>Payment Method</f7-block-title>
    <f7-list>
      <f7-list-item
              radio
              radio-icon="end"
              title="Cash On Delivery"
              name="payment"
      >
      </f7-list-item>
      <f7-list-item
              radio
              radio-icon="end"
              title="Algerie Post (CCP)"
              name="payment"
      >
      </f7-list-item>
    </f7-list>
    <f7-block>
      <f7-button fill @click="placeOrder">Place Order</f7-button>
    </f7-block>
  </f7-page>
</template>

<script>
  import {mapActions} from "vuex"

  export default {
    name: "Checkout",
    data() {
      return {
        shippingAddress: null,
        orderProducts: {},
        orderTotalPrice: {}
      }
    },
    methods: {
      ...mapActions({
        PlaceOrderAction: 'shop/PlaceOrderAction',
        ClearMyCartAction: 'shop/ClearMyCartAction'
      }),
      placeOrder() {
        this.$f7.dialog.confirm('Do You Want To Place This Order?', () => {
          let myOrder = {
            orderStatus: 'pending', //for now
            shippingAddress: this.shippingAddress,
            orderTotalPrice: this.orderTotalPrice.total,
            orderProducts: this.orderProducts,
          }

          this.PlaceOrderAction(myOrder).then(() => {
            this.$f7.dialog.alert('Your Order Has Been Placed!');
            this.ClearMyCartAction();
            this.$f7router.navigate('/');
          });

        })
      }
    },
    created() {
      this.orderProducts = this.$store.state.shop.myCart;
      this.orderTotalPrice = this.$store.state.shop.myCartTotal;
    },
  }
</script>

<style scoped>

</style>