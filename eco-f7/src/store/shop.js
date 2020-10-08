import axios from "axios";

export default {
  namespaced: true,
  state: {
    productAndGallery: null,
    categories: null,
    categoryProducts: null,
    myCart: null,
    myCartTotal: null,
    myOrders: null,
    myOrder: null,
  },
  getters:{
    myCartTotal(state){
      return state.myCartTotal
    },
    getMyOrders(state){
      return state.myOrders
    }

  },
  mutations: {
    SET_CATEGORY(state, categories){
      state.categories = categories;
    },
    SET_PRODUCT_AND_GALLERY(state, product){
      state.productAndGallery = product
    },
    SET_MY_CART(state, myCart){
      state.myCart = myCart
    },
    SET_MY_CART_TOTAL(state, myCartTotal){
      state.myCartTotal = myCartTotal
    },
    SET_MY_ORDERS(state, myOrders){
      state.myOrders = myOrders
    },
    SET_MY_ORDER(state, myOrder){
      state.myOrder = myOrder
    },
    SET_CATEGORY_PRODUCTS(state, products){
      state.categoryProducts = products
    }
  },
  actions:{
    ProductAndGalleryAction({ commit }, id){
      return axios.get(`products/gallery/${id}`).then(response =>{
        commit('SET_PRODUCT_AND_GALLERY', response.data)
      })
    },
    CategoriesAction({ commit }){
      return axios.get('CategoriesWithProducts').then(response =>{
        commit('SET_CATEGORY', response.data)
      });
    },
    CartAction({ commit }){
      return axios.post('cart/view').then(response =>{
        commit('SET_MY_CART', response.data)
        })
    },
    AddToMyCartAction(_, myProductInfo){
      return axios.post('cart/add', myProductInfo)
    },
    DeleteFromMyCartAction(_, id){
      return axios.post(`cart/remove/${id}`)
    },
    MyCartTotalAction({ commit }){
      return axios.post('cart/total').then(response =>{
        commit('SET_MY_CART_TOTAL', response.data)
      })
    },
    MyOrdersAction({ commit }){
      return axios.post('orders/view').then(response =>{
        commit('SET_MY_ORDERS', response.data)
      })
    },
    MyOrderAction({ commit }, orderId){
      return axios.post(`orders/order/${orderId}`).then(response =>{
        commit('SET_MY_ORDER', response.data)
      })
    },
    PlaceOrderAction({ dispatch }, order){
      return axios.post('orders/add', order).then(() =>{

        //Refresh the cart after placing the order
        dispatch('CartAction')
      })
    },
    ClearMyCartAction(){
      return axios.post('cart/clear')
    },
    CategoryProductsAction({ commit }, categoryID){
      return axios.get(`products/category/${categoryID}`).then(response =>{
        commit('SET_CATEGORY_PRODUCTS', response.data)
      })
    }
  },
}