<template>
  <div
    id="pcoded"
    class="pcoded isCollapsed"
    theme-layout="vertical"
    vertical-placement="left"
    vertical-layout="wide"
  >
    <div class="pcoded-container navbar-wrapper">
      <header-bar :user="user"></header-bar>
      <h2>App Layout</h2>
      <button @click="logout()">Salir</button>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { Helpers } from "./../helpers";

//Components
import HeaderBar from "./parts/HeaderBarComponent";

export default {
  components: {
    HeaderBar
  },
  data() {
    return {
      user: {}
    };
  },
  methods: {
    getUser() {
      this.$store.dispatch("getUser").then(result => (this.user = result.data));
    },
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
