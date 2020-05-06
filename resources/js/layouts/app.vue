<template>
  <div class="row">
    <h2>App Layout</h2>
    <p>{{user}}</p>
    <button @click="logout()">Salir</button>
    <router-view></router-view>
  </div>
</template>

<script>
import {Helpers} from "./../helpers";

export default {
  data() {
    return {
      user: {}
    };
  },
  methods: {
    getUser() {
      this.$store.dispatch("getUser").then(result => (this.user = result.data));
    },
    logout() {
      this.$store.dispatch("destroyToken").then(response => {
        this.$store.commit("SET_LAYOUT", "simple-layout");
        this.$router.push({ name: "login" });
      });
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
