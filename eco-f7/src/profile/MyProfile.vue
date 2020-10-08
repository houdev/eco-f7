<template>
  <f7-page>
    <f7-navbar title="My Profile" back-link></f7-navbar>
    <f7-card
        class="profileImage"
        :style="userPicture"
    >
    </f7-card>
    <span>{{ user.name }}</span>
    <f7-block>
      <f7-list>
        <f7-list-item>
          <f7-label>Name</f7-label>
          <f7-input
              name="name"
              type="text"
              placeholder="Name"
              :value="user.name"
          >
          </f7-input>
        </f7-list-item>
        <f7-list-item>
          <f7-label>Email</f7-label>
          <f7-input
              name="name"
              type="text"
              placeholder="Email"
              :value="user.email"
          >
          </f7-input>
        </f7-list-item>
        <f7-list-item>
          <f7-label>Phone</f7-label>
          <f7-input
              name="name"
              type="number"
              placeholder="Phone"
              :value="user.phone"
          >
          </f7-input>
          <f7-label>Address</f7-label>
          <f7-input
              name="name"
              type="text"
              placeholder="Address"
              :value="user.address"
          >
          </f7-input>
        </f7-list-item>
      </f7-list>
    </f7-block>
  </f7-page>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: "MyProfile",
    computed:{
      ...mapGetters({
        user: 'auth/user'
      }),
      userPicture(){
        return `background-image: url(${this.user.picture})`
      }
    }
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