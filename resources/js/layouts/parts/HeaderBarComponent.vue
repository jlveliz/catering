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
          <img src="./../../../images/svg/logo.svg" class="mx-auto w-25 img-fluid" />
        </b-link>

        <a class="mobile-menu" id="mobile-collapse" href="#!" @click="showMenu != showMenu">
          <feather type="toggle-right" class="icon-menu"></feather>
        </a>

        <a class="mobile-options waves-effect waves-light">
          <feather type="more-horizontal"></feather>
        </a>

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
  data() {
    return {
      showMenu : false
    }
  },
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
@media only screen and (max-width: 992px)  {
    .header-navbar .navbar-wrapper .navbar-logo a img {
        width: 8% !important;
    }
}
</style>

<style lang="scss" scoped>
@import './../../../sass/horizontal-menu.scss';
</style>