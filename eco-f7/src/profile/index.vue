<template>
  <div>
    <template v-if="authenticated">
      <f7-card
              class="profileImage"
              :style="userPicture"
      >
      </f7-card>
      <span>{{ user.name }}</span>
      <f7-block>
        <f7-list>
          <f7-list-item title="My Profile" link="/profile/my-profile/"></f7-list-item>
          <f7-list-item title="My Orders" link="/profile/my-orders/"></f7-list-item>
          <f7-list-item title="Sign Out" @click="signOut" link="#"></f7-list-item>
        </f7-list>
      </f7-block>
    </template>
    <f7-block v-else>
      <f7-button fill color="blue" login-screen-open="#login-screen">Sing-in / Sign-up</f7-button>
    </f7-block>
  </div>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'

  export default {
    name: "index",
    methods: {
      ...mapActions({
        signOutAction: 'auth/signOut'
      }),
      signOut() {
        this.$f7.dialog.confirm('Do You Want To Sign-out?.', () => {
          this.signOutAction().then(() => {
            this.$f7.dialog.alert('See You Again.');
            this.$f7router.navigate('/')
          });
        });

      }
    },
    computed: {
      ...mapGetters({
        authenticated: 'auth/authenticated',
        user: 'auth/user',
      }),
      userPicture() {
        return `background-image: url(${this.user.picture})`
      }
    },
  }
</script>

<style scoped>
  .profileImage {
    height: 25vw;
    width: 25vw;
    border: 2px solid #fff;
    border-radius: 50%;
    box-shadow: 0 0 5px gray;
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    background-size: contain;
  }

</style>