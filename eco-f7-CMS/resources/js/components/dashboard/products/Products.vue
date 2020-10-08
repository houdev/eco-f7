<template>
    <div>
        <v-main>
            <v-toolbar class="ma-5">

                <v-toolbar-title>Products <span class="blue--text">{{ products.length }}</span></v-toolbar-title>

                <v-spacer></v-spacer>
                <add-product @productAdded="getProducts"/>
            </v-toolbar>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">Title</th>
                                    <th class="text-left">Thumbnail</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Last Update</th>
                                    <th class="text-left">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>{{ product.name }}</td>
                                    <td class="pa-2">
                                        <v-img
                                            max-height="100"
                                            max-width="100"
                                            :src="product.thumbnail"
                                        ></v-img>
                                    </td>
                                    <td>{{ product.price }}</td>
                                    <td>{{ product.updated_at }}</td>
                                    <td>
                                        <v-btn
                                            fab
                                            small
                                            color="primary"
                                            :to="`/admin/product/${product.id}`"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                        <v-btn fab small color="red" dark @click="deleteButton(product.id)">
                                            <v-icon>mdi-delete</v-icon>
                                        </v-btn>
                                    </td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-card>
                </v-col>
            </v-row>
        </v-main>

        <!-- Delete Product Dialog -->
        <v-dialog
            v-model="deleteDialog"
            max-width="290"
        >
            <v-card>
                <v-card-title class="headline">
                    Delete This Product?
                </v-card-title>

                <v-card-text>
                    Do You Really Want To Delete This Product?
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="deleteDialog = false"
                    >
                        NO
                    </v-btn>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="deleteProduct(currentProductID)"
                    >
                        YES
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </div>
</template>

<script>
    import AddProduct from "./AddProduct";

    export default {
        name: "Products",
        components: {
            AddProduct
        },
        data() {
            return {
                products: {},
                currentProductID: null,
                deleteDialog: false,
            }
        },
        methods: {
            getProducts() {
                axios.get('api/products/view').then(response => {
                    this.products = response.data;
                });
            },
            deleteButton(productID) {
                this.currentProductID = productID;
                this.deleteDialog = true;
            },
            deleteProduct(productID) {
                axios.post(`web/product/delete/${productID}`).then(() => {
                    this.getProducts();
                    this.deleteDialog = false;
                });
            }
        },
        created() {
            this.getProducts();
        }
    }
</script>

<style scoped>

</style>
