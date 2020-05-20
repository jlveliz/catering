<template>
  <div
    id="pcoded"
    class="pcoded"
    nav-type="st2"
    theme-layout="horizontal"
    horizontal-placement="top"
    horizontal-layout="widebox"
    :pcoded-device-type="device"
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

// import './../../css/app.css';
// import './../../sass/horizontal-menu.scss';
// import './../../sass/app.scss'

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
      user: {},
      device: "desktop"
    };
  },
  methods: {
    getUser() {
      this.$store.dispatch("getUser").then(result => (this.user = result.data));
    },
    getScreenSize() {
      let winSize = window.innerWidth;
      if(winSize >= 765 && winSize <= 992) {
        this.device = "tablet";
      } else if (winSize >= 993) {
        this.device = "desktop"
      } else {
        this.device = "mobile";
      }
    }
  },
  created() {
    //Change Bg
    Helpers.removeBodyTheme();

    window.addEventListener('resize',this.getScreenSize)

    //Detect Changes on Screen
    this.getScreenSize();

    if (this.$store.getters.loggedIn) {
      this.getUser();
    }
  },
  destroyed() {
    window.addEventListener('resize',this.getScreenSize)
  }
};
</script>
