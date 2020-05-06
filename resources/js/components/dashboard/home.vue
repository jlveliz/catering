<template>
  <div>
    <div>{{user}}</div>
    <button @click="setLayout('simple-layout')">Simple layout</button>
    <button @click="setLayout('app-layout')">App layout</button>
    <button @click="logout()">Salir</button>
  </div>
</template>

<script>

export default {
  name: "Dashboard",
  data() {
    return {
      user: {}
    };
  },
  methods: {
    setLayout(layout) {
      this.$store.commit("SET_LAYOUT", layout);
    },
    logout() {
        this.$store.dispatch('destroyToken').then( response => {
            this.$store.commit('SET_LAYOUT','simple-layout');
            this.$router.push({name:'login'})
        })
    }
  },
  mounted() {
    this.user = this.$store.getters.getUser;
  }
};
</script>

<style>
</style>
