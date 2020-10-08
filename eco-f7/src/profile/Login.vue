<template>
  <!-- Login Screen -->
  <f7-login-screen id="login-screen">
    <f7-view>
      <f7-page login-screen>
        <template v-if="!signUp">
          <f7-login-screen-title>Login</f7-login-screen-title>
          <f7-list form id="loginform">
            <f7-list-item>
              <f7-label>Email</f7-label>
              <f7-input
                      name="email"
                      placeholder="Email"
                      type="text"
                      :value="loginForm.email"
                      @input="loginForm.email = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
            <f7-list-item>
              <f7-label>Password</f7-label>
              <f7-input
                      name="password"
                      type="password"
                      placeholder="Password"
                      :value="loginForm.password"
                      @input="loginForm.password = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
          </f7-list>
          <f7-list>
            <f7-block-footer>
              <f7-button fill color="green" @click="loginSubmit">Login</f7-button>
              <br/>
              <f7-button @click="signUpButton">I Don't Have An Account</f7-button>
              <br/>
              <f7-button login-screen-close>Go Back</f7-button>
            </f7-block-footer>
          </f7-list>
        </template>

        <template v-if="signUp">
          <f7-login-screen-title>Sign Up</f7-login-screen-title>
          <f7-list form id="signUpForm">
            <f7-list-item>
              <f7-label>Full Name</f7-label>
              <f7-input
                      name="name"
                      placeholder="Full Name"
                      type="text"
                      :value="signUpForm.name"
                      @input="signUpForm.name = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
            <f7-list-item>
              <f7-label>Email</f7-label>
              <f7-input
                      name="email"
                      placeholder="Email"
                      type="text"
                      :value="signUpForm.email"
                      @input="signUpForm.email = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
            <f7-list-item>
              <f7-label>Password</f7-label>
              <f7-input
                      name="password"
                      type="password"
                      placeholder="Password"
                      :value="signUpForm.password"
                      @input="signUpForm.password = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
            <f7-list-item>
              <f7-label>Address</f7-label>
              <f7-input
                      name="address"
                      type="text"
                      placeholder="Address"
                      :value="signUpForm.address"
                      @input="signUpForm.address = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
            <f7-list-item>
              <f7-label>Phone</f7-label>
              <f7-input
                      name="phone"
                      type="number"
                      placeholder="Phone"
                      :value="signUpForm.phone"
                      @input="signUpForm.phone = $event.target.value"
              >
              </f7-input>
            </f7-list-item>
          </f7-list>
          <f7-list>
            <f7-block-footer>
              <f7-button fill color="green" @click="signUpSubmit">Sign Up</f7-button>
              <br/>
              <f7-button @click="signUpButton">I Do Have An Account</f7-button>
              <br/>
              <f7-button login-screen-close>Go Back</f7-button>
            </f7-block-footer>
          </f7-list>
        </template>

      </f7-page>
    </f7-view>
  </f7-login-screen>
</template>

<script>
  import {mapActions} from 'vuex'

  export default {
    name: "Login",
    data() {
      return {
        loginForm: {
          email: null,
          password: null,
        },
        signUpForm: {
          name: null,
          email: null,
          password: null,
          address: null,
          phone: null,
        },
        signUp: false,
      }
    },
    methods: {
      ...mapActions({
        signIn: 'auth/signIn',
        signUpAction: 'auth/signUp'
      }),
      loginSubmit() {
        this.signIn(this.loginForm).then(() => this.$f7.loginScreen.close());
      },
      signUpButton() {
        this.signUp = !this.signUp;
      },
      signUpSubmit() {
        this.signUpAction(this.signUpForm).then(() => {
          this.$f7.dialog.alert('Your Account Has Been Created, Now You Can Log-in');
          this.signUp = false;
          //close loginScreen window
          this.$f7.loginScreen.close();
        })
      }
    }
  }
</script>

<style scoped>

</style>