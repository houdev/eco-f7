<template>
    <div>
        <v-app-bar
            color="deep-purple accent-4"
            dense
            dark
            app
        >
            <v-toolbar-title>Eco-F7 CMS</v-toolbar-title>
        </v-app-bar>
        <v-main>
            <v-container fill-height="fill-height">
                <v-layout align-center="align-center" justify-center="justify-center">
                    <v-flex class="login-form text-xs-center">
                        <div class="display-1 mb-3">
                            <v-icon class="mr-2" large="large">mdi-fingerprint</v-icon>
                            Eco-F7 CMS
                        </div>
                        <v-card light="light">
                            <v-card-text>
                                <div class="subheading">
                                    <template>Log in to your control panel</template>
                                </div>
                                <v-form>
                                    <v-text-field
                                        v-model="loginForm.email"
                                        prepend-icon="mdi-email"
                                        label="Email"
                                        type="email"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="loginForm.password"
                                        prepend-icon="mdi-lock"
                                        label="Password"
                                        type="password"
                                    ></v-text-field>
                                    <v-btn
                                        @click="loginButton"
                                        block="block"
                                    >
                                        Sign in
                                    </v-btn>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
        <v-footer app="app">
            <v-flex class="text-xs-center">© 2018. All rights reserved.</v-flex>
        </v-footer>
    </div>
</template>

<script>
    export default {
        name: "LoginPage",
        data() {
            return {
                loginForm: {
                     email: null,
                     password: null,
                },
            }
        },
        methods:{
            loginButton(){
                this.$auth.login ({
                    data:{
                        email: this.loginForm.email,
                        password: this.loginForm.password
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .login-form {
        max-width: 500px
    }
</style>
