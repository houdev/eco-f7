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
                    <v-toolbar-title>Add New Category</v-toolbar-title>
                </v-toolbar>
                <v-main>
                    <v-container>
                        <v-row>
                            <v-col cols="8">
                                <v-form>
                                    <v-text-field
                                        v-model="name"
                                        label="Name"
                                    ></v-text-field>
                                    <v-textarea
                                        v-model="description"
                                        name="description"
                                        label="Description"
                                    ></v-textarea>
                                    <v-file-input
                                        v-model="icon"
                                        label="Add Icon"
                                        filled
                                        prepend-icon="mdi-camera"
                                    ></v-file-input>
                                    <v-file-input
                                        v-model="cover"
                                        label="Add Cover"
                                        filled
                                        prepend-icon="mdi-camera"
                                    ></v-file-input>
                                    <v-btn block color="success" @click="addCategory">
                                        Add New Category
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
        name: "AddCategory",
        data() {
            return {
                dialog: false,
                name: null,
                description: null,
                icon: null,
                cover: null
            }
        },
        methods: {
            addCategory() {
                let newCategory = new FormData()
                newCategory.append('name', this.name)
                newCategory.append('description', this.description)
                newCategory.append('icon', this.icon)
                newCategory.append('cover', this.cover)
                axios.post('web/category/add', newCategory).then(() => {

                    //send 'categoryAdded' event to refresh categories list
                    this.$emit('categoryAdded');

                    this.dialog = false;
                })
            }
        }
    }
</script>

<style scoped>

</style>
