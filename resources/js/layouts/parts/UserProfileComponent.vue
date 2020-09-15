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
          <feather type="log-out"></feather>Salir
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    username: {
      type: String,
      default: ""
    }
  },
  components: {
    // LogOutIcon
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

<style scoped>
ul.show-notification li:hover {
  background-color: #f1f1f1 !important;
}
</style>
