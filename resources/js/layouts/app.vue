<template>
  <div
    id="pcoded"
    class="pcoded"
    nav-type="st2"
    theme-layout="horizonal"
    horizontal-placement="top"
    horizontal-layout="widebox"
    pcoded-device-type="desktop"
    hnavigation-view="view1"
    fream-type="theme1"
    layout-type="light"
  >
    <div class="pcoded-container navbar-wrapper">
      <header-bar :user="user"></header-bar>
      <div class="pcoded-main-container" style="margin-top:70px">
        <div class="pcoded-wrapper">
          <navbar-menu-component></navbar-menu-component>
          <content-Component></content-Component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Helpers } from "./../helpers";

//Components
import HeaderBar from "./parts/HeaderBarComponent";
import NavbarMenuComponent from "./parts/NavbarMenuComponent";
import ContentComponent from "./parts/ContentComponent";

export default {
  components: {
    HeaderBar,
    NavbarMenuComponent,
    ContentComponent
  },
  data() {
    return {
      user: {}
    };
  },
  methods: {
    getUser() {
      this.$store.dispatch("getUser").then(result => (this.user = result.data));
    }
  },
  created() {
    //Change Bg
    Helpers.removeBodyTheme();

    if (this.$store.getters.loggedIn) {
      this.getUser();
    }
  }
};
</script>
