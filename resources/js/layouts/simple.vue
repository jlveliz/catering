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

import { Helpers } from "./../helpers";

export default {
  created() {
    Helpers.setBodyTheme("theme1");
  }
};
</script>
<style>
.login-block {
  margin: 30px auto;
  min-height: 93.6vh;
}

.login-block .auth-box {
  margin: 20px auto 0 auto;
  max-width: 450px;
}
</style>
