<template>
  <f7-page>
    <f7-navbar>
      <f7-nav-left>
        <f7-link icon-if-ios="f7:menu" icon-if-md="material:menu" panel-open="left"></f7-link>
      </f7-nav-left>
      <f7-nav-title>ECO-F7</f7-nav-title>
      <f7-nav-right>
        <f7-link
                class="searchbar-enable"
                data-searchbar=".searchbar"
                icon-ios="f7:search"
                icon-aurora="f7:search"
                icon-md="material:search"
        >
        </f7-link>
      </f7-nav-right>
      <f7-searchbar
              class="searchbar"
              search-container=".card-content"
              search-in=".product-name"
              expandable
      >
      </f7-searchbar>
    </f7-navbar>

    <f7-toolbar tabbar labels position="bottom" class="toolbar-bottom-md">
      <f7-link
              tab-link="#tab-1"
              tab-link-active
              text="Home"
              icon-ios="f7:house"
              icon-aurora="f7:house"
              icon-md="material:home"
              class="searchbar-found"
      ></f7-link>
      <f7-link tab-link="#tab-2">
        <f7-icon ios="f7:cart_fill" aurora="f7:cart_fill" md="material:shopping_cart">
          <f7-badge color="red">{{ countCartItems }}</f7-badge>
        </f7-icon>
        <span>Cart</span>
      </f7-link>
      <f7-link
              tab-link="#tab-3"
              text="Profile"
              icon-ios="f7:person_fill"
              icon-aurora="f7:person_fill"
              icon-md="material:person"
      ></f7-link>
    </f7-toolbar>
    <f7-tabs animated>
      <f7-tab id="tab-1" tab-active>
        <f7-swiper pagination :params="{autoplay:{ delay:3000, disableOnInteraction:false }}">
          <f7-swiper-slide>
            <img src="https://dz.jumia.is/cms/00_Camp20/September/W37/Sx-ptit-prix-vet2.jpg" width="100%"/>
          </f7-swiper-slide>
          <f7-swiper-slide>
            <img src="https://dz.jumia.is/cms/0020_MLP/September/PetitPrix/Tech/sx-tech.jpg" width="100%"/>
          </f7-swiper-slide>
          <f7-swiper-slide>
            <img src="https://dz.jumia.is/cms/0020_MLP/September/sx-backsc.jpg" width="100%"/>
          </f7-swiper-slide>
          <f7-swiper-slide>
            <img src="https://dz.jumia.is/cms/00_Camp20/September/W37/sx-cuisineeee2.jpg" width="100%"/>
          </f7-swiper-slide>
        </f7-swiper>

        <f7-list class="searchbar-not-found">
          <f7-list-item title="Nothing found"></f7-list-item>
        </f7-list>

        <f7-block-title>Top Categories</f7-block-title>
        <f7-swiper :params="{speed: 500, slidesPerView: 3 }">
          <f7-swiper-slide v-for="category in categories" v-bind:key="category.id">
            <f7-card>
              <f7-card-content>
                <img :src="category.icon" width="100%" @click="openCategoryProducts(category.id)"/>
                <p>{{ category.name }}</p>
              </f7-card-content>
            </f7-card>
          </f7-swiper-slide>
        </f7-swiper>

        <div v-for="category in categories" v-bind:key="category.id">
          <f7-block-title>{{ category.name }}</f7-block-title>
          <f7-row no-gap>
            <f7-col width="50" v-for="product in category.products" :key="product.id">
              <f7-card>
                <f7-card-content>
                  <p class="product-name">{{ product.name }}</p>
                  <img :src="product.thumbnail" width="100%"/>
                </f7-card-content>
                <f7-card-footer class="no-border">
                  <f7-button fill @click="openProduct(product.id)">Buy</f7-button>
                  <f7-link color="red">{{ product.price }} DZD</f7-link>
                </f7-card-footer>
              </f7-card>
            </f7-col>
          </f7-row>
        </div>

        <!-- Advertising section -->
        <f7-block xlarge-inset>
          <img src="https://dz.jumia.is/cms/0020_MLP/September/sx-backsc.jpg" width="100%"/>
        </f7-block>

      </f7-tab>
      <f7-tab id="tab-2" class="page-content">
        <cart/>
      </f7-tab>
      <f7-tab id="tab-3" class="page-content">
        <profile-index/>
      </f7-tab>
    </f7-tabs>

  </f7-page>
</template>
<script>
  import { mapActions, mapGetters } from 'vuex';
  import ProfileIndex from '../profile/index';
  import Cart from './cart';

  export default {
    components: {
      ProfileIndex,
      Cart
    },
    data() {
      return {
        categories: {},
      }
    },
    methods: {
      openProduct(productID) {
        this.$f7router.navigate(`/Product/${productID}`)
      },
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
    computed: {
      ...mapGetters({
        authenticated: 'auth/authenticated'
      }),
      countCartItems() {
        if (this.authenticated) {
          if (this.$store.state.shop.myCart) {
            return this.$store.state.shop.myCart.length;
          }
        }
        return 0
      }
    },
    created() {
      this.getCategories()
    },

  }
</script>

<style>
  .tabs-animated-wrap > .tabs > .tab {
    overflow: auto;
    -webkit-overflow-scrolling: touch;
  }
</style>
