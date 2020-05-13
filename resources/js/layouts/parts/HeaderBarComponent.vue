<template>
  <nav
    class="navbar header-navbar pcoded-header"
    header-theme="theme1"
    pcoded-header-position="fixed"
  >
    <div class="navbar-wrapper">
      <div class="navbar-logo" logo-theme="theme1">
        <!-- TODO LOGO -->
        <b-link :to="{name:'home'}" go>
            <img src="./../../../images/svg/logo.svg" class="img-fluid">
        </b-link>
      </div>
      <div class="navbar-container container-fluid d-inline">
        <ul class="nav-right">
          <li class="user-profile header-notification">
            <user-profile :username="this.user.name + ' ' + this.user.lastname"></user-profile>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import UserProfile from "./UserProfileComponent";

export default {
  name: "HeaderBar",
  props: {
    user: {
      type: Object,
      default: {}
    }
  },
  components: {
    UserProfile
  }
};
</script>

<style scoped>
    .navbar-logo img {
        width: 30%;
    }
</style>
