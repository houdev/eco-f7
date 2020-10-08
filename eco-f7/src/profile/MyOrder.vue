<template>
  <f7-page>
    <f7-navbar :title="`Order ID ${orderId}`" back-link></f7-navbar>
    <f7-block-title>Order ID {{ orderId }}</f7-block-title>
    <f7-list>
      <f7-list-item v-for="order in myOrder" :key="order.id">
        <span>{{ order.product_name }}</span>
        <span>{{ order.product_price }} DZD</span>
        <span>X{{ order.product_quantity }}</span>
        <span>{{ order.product_total_price }} DZD</span>
      </f7-list-item>
    </f7-list>
  </f7-page>
</template>

<script>
  import {mapActions} from 'vuex'

  export default {
    name: "MyOrder",
    data() {
      return {
        orderId: null,
        myOrder: {}
      }
    },
    methods: {
      ...mapActions({
        MyOrderAction: 'shop/MyOrderAction'
      })
    },
    created() {
      this.MyOrderAction(this.$f7route.params.orderId).then(() => {
        this.myOrder = this.$store.state.shop.myOrder;
      });
      this.orderId = this.$f7route.params.orderId;
    }
  }
</script>

<style scoped>

</style>