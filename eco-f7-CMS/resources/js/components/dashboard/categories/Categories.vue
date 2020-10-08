<template>
    <div>
        <v-main>
            <v-toolbar class="ma-5">

                <v-toolbar-title>Categories <span class="blue--text">{{ categories.length }}</span></v-toolbar-title>

                <v-spacer></v-spacer>
                <add-category @categoryAdded="getCategories"/>
            </v-toolbar>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">Title</th>
                                    <th class="text-left">Icon</th>
                                    <th class="text-left">Last Update</th>
                                    <th class="text-left">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="category in categories" :key="category.id">
                                    <td>{{ category.name }}</td>
                                    <td class="pa-2">
                                        <v-img
                                            max-height="30"
                                            max-width="30"
                                            :src="category.icon"
                                        ></v-img>
                                    </td>
                                    <td>{{ category.updated_at }}</td>
                                    <td>
                                        <v-btn
                                            fab
                                            small
                                            color="primary"
                                            @click="editCategoryButton(category.id, category.name, category.description, category.icon, category.cover)"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                        <v-btn fab small color="red" dark @click="deleteCategoryButton(category.id)">
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

        <!-- Edit Category Dialog -->
        <v-dialog
            v-model="editDialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar
                    dark
                    color="primary"
                >
                    <v-btn
                        icon
                        dark
                        @click="editDialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Edit {{ currentCategory.name }} Category</v-toolbar-title>
                </v-toolbar>
                <v-main>
                    <v-container>
                        <v-row>
                            <v-col cols="8">
                                <v-form>
                                    <v-text-field
                                        v-model="currentCategory.name"
                                        label="Name"
                                    ></v-text-field>
                                    <v-textarea
                                        v-model="currentCategory.description"
                                        name="description"
                                        label="Description"
                                    ></v-textarea>
                                    <v-row>
                                        <v-col cols="8">
                                            <v-file-input
                                                v-model="newCategoryIcon"
                                                label="Add Icon"
                                                filled
                                                prepend-icon="mdi-camera"
                                            ></v-file-input>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-img
                                                max-height="50"
                                                max-width="50"
                                                :src="currentCategory.icon"
                                            ></v-img>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="8">
                                            <v-file-input
                                                v-model="newCategoryCover"
                                                label="Add Cover"
                                                filled
                                                prepend-icon="mdi-camera"
                                            ></v-file-input>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-img
                                                max-height="300"
                                                max-width="400"
                                                :src="currentCategory.cover"
                                            ></v-img>
                                        </v-col>
                                    </v-row>
                                    <v-btn block color="success" @click="updateCategory(currentCategory.id)">
                                        Edit {{ currentCategory.name }} Category
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-main>
            </v-card>
        </v-dialog>

        <!-- Delete Category Dialog -->
        <v-dialog
            v-model="deleteDialog"
            max-width="290"
        >
            <v-card>
                <v-card-title class="headline">
                    Delete This Category?
                </v-card-title>

                <v-card-text>
                    Do You Really Want To Delete This Category?
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
                        @click="deleteCategory(currentCategory.id)"
                    >
                        YES
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    import AddCategory from "./AddCategory";

    export default {
        name: 'Categories',
        components: {
            AddCategory
        },
        data() {
            return {
                categories: {},
                currentCategory: {
                    id: null,
                    name: null,
                    description: null,
                    icon: null,
                    cover: null,
                },
                newCategoryIcon: null,
                newCategoryCover: null,
                editDialog: false,
                deleteDialog: false
            }
        },
        methods: {
            getCategories() {
                axios.get('api/category').then(response => {
                    this.categories = response.data
                })
            },
            editCategoryButton(id, name, description, icon, cover) {
                this.currentCategory.id = id;
                this.currentCategory.name = name;
                this.currentCategory.description = description;
                this.currentCategory.icon = icon;
                this.currentCategory.cover = cover;

                this.editDialog = true;
            },
            updateCategory(categoryId) {

                let updateCategoryData = new FormData();
                updateCategoryData.append('name', this.currentCategory.name)
                updateCategoryData.append('description', this.currentCategory.description)
                updateCategoryData.append('icon', this.newCategoryIcon)
                updateCategoryData.append('cover', this.newCategoryCover)

                axios.post(`web/category/update/${categoryId}`, updateCategoryData).then(() => {

                    //Refresh Categories list
                    this.getCategories();
                    //Close the dialog
                    this.editDialog = false;
                })
            },
            deleteCategoryButton(categoryID) {
                this.currentCategory.id = categoryID;
                this.deleteDialog = true;
            },
            deleteCategory(categoryID) {
                axios.post(`web/category/delete/${categoryID}`).then(() => {

                    //Refresh Categories list
                    this.getCategories();
                    //Close dialog
                    this.deleteDialog = false;
                })
            }
        },
        created() {
            this.getCategories();
        }
    }
</script>
