<template>
  <f7-page>
    <f7-navbar title="My Orders" back-link></f7-navbar>
    <f7-block-title>My Orders</f7-block-title>
    <f7-list>
      <f7-list-item
              v-for="order in myOrders"
              :key="order.id"
              :link="`/profile/my-order/${order.id}`"
      >
        <span>
          Order ID: <b>{{ order.id }}</b>
        </span>
        <span>
          Status: <b>{{ order.order_status }}</b>
        </span>
        <span>Read More</span>
      </f7-list-item>
    </f7-list>
  </f7-page>
</template>

<script>
  import {mapActions} from 'vuex'

  export default {
    name: "MyOrders",
    data() {
      return {
        myOrders: {}
      }
    },
    methods: {
      ...mapActions({
        MyOrdersAction: 'shop/MyOrdersAction'
      })
    },
    watch: {
      '$store.state.auth.user'() {
        this.MyOrdersAction();
      }
    },
    created() {
      this.MyOrdersAction().then(() => {
        this.myOrders = this.$store.state.shop.myOrders;
      })
    },
  }
</script>

<style scoped>

</style>