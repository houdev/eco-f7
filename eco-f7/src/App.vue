<template>

  <!-- App -->
  <f7-app :params="f7params">

    <!-- Statusbar -->
    <f7-statusbar></f7-statusbar>

    <!-- Left Panel -->
    <f7-panel left reveal theme-dark>
      <f7-view url="/panel-left/"></f7-view>
    </f7-panel>

    <!-- Main View -->
    <f7-view id="main-view" url="/" main></f7-view>

  <login />

  </f7-app>
</template>

<script>
// Import Routes
import routes from './routes.js'
import Login from './profile/Login'

export default {
  components:{
    Login
  },
  data() {
    return {
      // Framework7 parameters here
      f7params: {
        id: 'io.framework7.eco-f7', // App bundle ID
        name: 'Eco-F7', // App name
        theme: 'auto', // Automatic theme detection
        // App routes
        routes: routes,
      },
    }
  },

}
</script>
