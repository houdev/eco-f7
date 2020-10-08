<template>
    <div>
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
                                name="Name"
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
                                v-model="quantity"
                                label="Stock Quantity"
                                type="number"
                            ></v-text-field>
                            <v-row>
                                <v-col cols="8">
                                    <v-file-input
                                        v-model="thumbnail"
                                        label="Add Thumbnail"
                                        filled
                                        prepend-icon="mdi-camera"
                                    ></v-file-input>
                                </v-col>
                                <v-col cols="4">
                                    <v-img
                                        max-height="100"
                                        max-width="100"
                                        :src="thumbnail"
                                    ></v-img>
                                </v-col>
                            </v-row>

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
                                    <v-chip small text-color="white" color="#295671" close @click:close="remove(index)">
                                        {{ text }}
                                    </v-chip>
                                </template>
                            </v-file-input>
                            <div v-if="productImages.length">
                                <h5>All Images</h5>
                                <v-chip v-for="{image, index} in productImages" :key="index" class="mr-1">
                                    {{ image.name }}
                                </v-chip>
                            </div>

                            <v-row>
                                <v-col cols="3" v-for="gallery in productGallery" :key="gallery.id">
                                    <v-img
                                        max-height="350"
                                        max-width="400"
                                        :src="gallery.image"
                                    ></v-img>
                                </v-col>
                            </v-row>

                            <v-btn block color="success" @click="updateProduct">
                                Edit This Product
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </div>
</template>

<script>
    export default {
        name: "EditProduct",
        data() {
            return {
                categories: null,
                selectedCategory: null,
                name: null,
                description: null,
                price: null,
                thumbnail: null,
                quantity: null,
                productGallery: null,
                currentImages: [],
                productImages: []
            }
        },
        methods: {
            getProduct() {
                let productId = this.$route.params.id;
                axios.get(`api/products/gallery/${productId}`).then(response => {
                    let product = response.data;

                    this.name = product.name;
                    this.description = product.description;
                    this.price = product.price;
                    this.thumbnail = product.thumbnail;
                    this.quantity = product.quantity;
                    this.selectedCategory = product.category_id;
                    this.productGallery = product.gallery;

                })
            },
            getCategories() {
                axios.get('api/category').then(response => {
                    this.categories = response.data;
                })
            },
            remove(index) {
                this.productImages.splice(index, 1)
            },
            inputImagesChanged() {
                this.productImages = [
                    ...this.currentImages,
                    ...this.productImages
                ]
            },
            updateProduct() {
                let productId = this.$route.params.id;
                let $updatedProduct = new FormData();

                $updatedProduct.append('category_id', this.selectedCategory);
                $updatedProduct.append('name', this.name);
                $updatedProduct.append('description', this.description);
                $updatedProduct.append('price', this.price);
                $updatedProduct.append('thumbnail', this.thumbnail);
                $updatedProduct.append('stock_quantity', this.quantity);

                for (var i = 0; i < this.productImages.length; i++) {
                    $newProduct.append(`gallery[${i}]`, this.productImages[i]);
                }

                axios.post(`web/product/update/${productId}`, $updatedProduct).then(() => {

                    this.$router.push('/admin/products')

                });
            }
        },
        created() {
            this.getProduct();
            this.getCategories();
        }
    }
</script>

<style scoped>

</style>
