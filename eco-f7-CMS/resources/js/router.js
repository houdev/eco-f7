import Vue from 'vue'
import VueRouter from "vue-router";
import Categories from "./components/dashboard/categories/Categories";
import Index from "./components/dashboard/Index";
import LoginPage from "./components/LoginPage";
import Products from "./components/dashboard/products/Products";
import EditProduct from "./components/dashboard/products/EditProduct";

Vue.use(VueRouter);

export default new VueRouter({
    routes:[
        {
            path: '/admin',
            component: Index,
            meta:{
                auth:true
            },
            children:[
                {
                    path: 'categories',
                    name: 'Categories',
                    component: Categories,
                },
                {
                    path: 'products',
                    name: 'Products',
                    component: Products,
                },
                {
                    path: 'product/:id',
                    name: 'EditProduct',
                    component: EditProduct,
                },
            ]
        },
        {
            path: '/login',
            component: LoginPage,
        }

    ],
    mode:'history'
})
