<template>
  <section class="login-block">
    <b-container fluid>
      <b-row>
        <b-col sm="12">
          <router-view></router-view>
        </b-col>
      </b-row>
    </b-container>
  </section>
</template>

<script>
import("./../../css/simple.css");

import Helpers from "./../helpers";

export default {
  created() {
    new Helpers().setBodyTheme("theme1");
  }
};
</script>
<style>
</style>
