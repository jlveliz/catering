<template>
  <div class="dropdown-primary dropdown">
    <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <b-icon-person-fill></b-icon-person-fill>
      <span>{{username}}</span>
      <b-icon-caret-down-fill scale="0.5"></b-icon-caret-down-fill>
    </div>
    <ul
      class="show-notification profile-notification dropdown-menu"
      data-dropdown-in="fadeIn"
      data-dropdown-out="fadeOut"
    >
      <li>
        <a @click="logout()">
          <log-out-icon></log-out-icon>Salir
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import { LogOutIcon } from "vue-feather-icons";
export default {
  props: {
    username: {
      type: String,
      default: ""
    }
  },
  components: {
    LogOutIcon
  },
  methods: {
    logout() {
      this.$store.dispatch("destroyToken").then(response => {
        this.$store.commit("SET_LAYOUT", "simple-layout");
        this.$router.push({ name: "login" });
      });
    }
  }
};
</script>

<style>
</style>
