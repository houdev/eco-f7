<template>
    <div>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <template v-slot:activator="{ on }">
                <v-btn block color="success" v-on="on">
                    New
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <v-card>
                <v-toolbar
                    dark
                    color="primary"
                >
                    <v-btn
                        icon
                        dark
                        @click="dialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Add New Product</v-toolbar-title>
                </v-toolbar>
                <v-main>
                    <v-container>
                        <v-row>
                            <v-col cols="8">
                                <v-form>
                                    <v-select
                                        :items="categories"
                                        label="Select Category"
                                        item-text="name"
                                        item-value="id"
                                        v-model="selectedCategory"
                                    ></v-select>
                                    <v-text-field
                                        v-model="name"
                                        label="Name"
                                    ></v-text-field>
                                    <v-textarea
                                        v-model="description"
                                        name="description"
                                        label="Description"
                                    ></v-textarea>
                                    <v-text-field
                                        v-model="price"
                                        label="Price"
                                        type="number"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="stockQuantity"
                                        label="Stock Quantity"
                                        type="number"
                                    ></v-text-field>
                                    <v-file-input
                                        v-model="thumbnail"
                                        label="Add Thumbnail"
                                        filled
                                        prepend-icon="mdi-camera"
                                    ></v-file-input>

                                    <!--Gallery Upload-->
                                    <v-file-input
                                        v-model="currentImages"
                                        small-chips
                                        show-size
                                        multiple
                                        clearable
                                        label="Add Product Images"
                                        @change="inputImagesChanged"
                                        prepend-icon="mdi-camera"
                                    >
                                        <template v-slot:selection="{ text, index, file }">
                                            <v-chip small text-color="white" color="#295671" close
                                                    @click:close="remove(index)">
                                                {{ text }}
                                            </v-chip>
                                        </template>
                                    </v-file-input>
                                    <div v-if="productImages.length">
                                        <h5>All Images</h5>
                                        <v-chip v-for="{image, index} in productImages" :key="index" class="mr-1">
                                            {{ image.name }}
                                        </v-chip>
                                        <br/><br/><br/>

                                    </div>

                                    <v-btn block color="success" @click="addProduct">
                                        Add New Product
                                        <v-icon>mdi-plus</v-icon>
                                    </v-btn>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-main>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddProduct",
        data() {
            return {
                dialog: false,
                categories: {},
                selectedCategory: null,
                name: null,
                description: null,
                price: null,
                thumbnail: null,
                stockQuantity: null,
                currentImages: [],
                productImages: []
            }
        },
        methods: {
            remove(index) {
                this.productImages.splice(index, 1)
            },
            inputImagesChanged() {
                this.productImages = [
                    ...this.currentImages,
                    ...this.productImages
                ]
            },
            getCategories() {
                axios.get('api/category').then(response => {
                    this.categories = response.data;
                })
            },
            addProduct() {
                let $newProduct = new FormData();
                $newProduct.append('category_id', this.selectedCategory);
                $newProduct.append('name', this.name);
                $newProduct.append('description', this.description);
                $newProduct.append('price', this.price);
                $newProduct.append('thumbnail', this.thumbnail);
                $newProduct.append('stock_quantity', this.stockQuantity);

                for (var i = 0; i < this.productImages.length; i++) {
                    $newProduct.append(`gallery[${i}]`, this.productImages[i]);
                }

                axios.post('web/product/add', $newProduct).then(() => {

                    //Refresh products list in products page
                    this.$emit('productAdded');

                    //Close the dialog
                    this.dialog = false;

                });
            }
        },
        created() {
            this.getCategories();
        }
    }
</script>

<style scoped>

</style>
