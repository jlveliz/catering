<template>
  <nav
    class="navbar header-navbar pcoded-header iscollapsed"
    header-theme="themelight1"
    pcoded-header-position="fixed"
  >
    <div class="navbar-wrapper">
      <div class="navbar-logo" logo-theme="theme6">
        <p class="text-center text-white col-sm-12">Catering</p>
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

<style>
</style>
