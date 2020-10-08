<template>
    <div>
        <v-navigation-drawer v-model="drawer" app>
            <v-list dense>
                    <v-list-item to="/admin">
                        <v-list-item-icon>
                            <v-icon>mdi-home</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item>

                    <v-list-item to="/admin/categories">
                        <v-list-item-icon>
                            <v-icon>mdi-layers-triple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Categories</v-list-item-title>
                    </v-list-item>

                    <v-list-item to="/admin/products">
                        <v-list-item-icon>
                            <v-icon>mdi-package-variant</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Products</v-list-item-title>
                    </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            color="deep-purple accent-4"
            dense
            dark
            app
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Eco-F7 CMS</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-menu
                left
                bottom
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        icon
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item
                        v-for="n in 5"
                        :key="n"
                        @click="() => {}"
                    >
                        <v-list-item-title>Option {{ n }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>



        <v-main class="pa-0">
            <v-container>
                <router-view />
            </v-container>
        </v-main>

    </div>
</template>

<script>
  export default {
    name: "Home",
      data(){
          return{
              drawer: true,
              group: null,
          }
      }
  }
</script>

<style scoped>

</style>
