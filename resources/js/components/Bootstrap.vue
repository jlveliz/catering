<template>
  <component v-bind:is="layout"></component>
</template>

<script>
import AppLayout from "./../layouts/app";
import SimpleLayout from "./../layouts/simple";

export default {
  computed: {
    layout() {
      return this.$store.getters.layout;
    }
  },
  methods: {
    setLayout() {
      if (this.$store.getters.loggedIn) {
        this.$store.commit("SET_LAYOUT", "app-layout");
      } else {
        this.$store.commit("SET_LAYOUT", "simple-layout");
      }
    }
  },
  components: {
    "simple-layout": SimpleLayout,
    "app-layout": AppLayout
  },
  created() {
    this.setLayout();
  },
  mounted() {}
};
</script>
