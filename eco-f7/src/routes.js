import HomePage from './shop/home.vue';
import AboutPage from './pages/about.vue';
import NotFoundPage from './pages/not-found.vue';
import PanelLeftPage from './pages/panel-left.vue';
import Product from './shop/product.vue';
import ProfileIndex from './profile/index.vue';
import Checkout from "./shop/Checkout";
import MyProfile from "./profile/MyProfile";
import MyOrders from "./profile/MyOrders";
import MyOrder from "./profile/MyOrder";
import CategoryProducts from "./shop/categories/CategoryProducts";
import ViewCategories from "./shop/categories/ViewCategories";

export default [
  {
    path: '/',
    component: HomePage,
  },
  {
    path: '/panel-left/',
    component: PanelLeftPage,
  },
  {
    path: '/about/',
    component: AboutPage,
  },
  {
    path: '/product/:productId',
    component: Product,
  },
  {
    path: '/categories/view/',
    component: ViewCategories,
  },
  {
    path: '/categories/category/:categoryID',
    component: CategoryProducts,
  },
  {
    path: '/profile/index/',
    component: ProfileIndex,
  },
  {
    path: '/profile/my-profile/',
    component: MyProfile,
  },
  {
    path: '/profile/my-orders/',
    component: MyOrders,
  },
  {
    path: '/profile/my-order/:orderId',
    component: MyOrder,
  },
  {
    path: '/checkout/',
    component: Checkout,
  },
  {
    path: '(.*)',
    component: NotFoundPage,
  },
];
