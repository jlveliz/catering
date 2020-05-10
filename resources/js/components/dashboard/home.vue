<template>
  <div>
    <content-header-component>
      <b-col lg="8">
        <div class="page-header-title">
          <home-icon  class="bg-c-blue"></home-icon>
          <div class="d-inline">
            <h5>Escritorio</h5>
            <span>Muestra datos relevantes del negocio</span>
          </div>
        </div>
      </b-col>
    </content-header-component>

    <content-main-content-component>
      <div class="card">
        <div class="card-header">Dashboard</div>
      </div>
    </content-main-content-component>
  </div>
</template>

<script>
import { HomeIcon } from "vue-feather-icons";
import ContentHeaderComponent from "./../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../layouts/parts/ContentMainContentComponent";
export default {
  name: "Dashboard",
  components: {
    HomeIcon,
    ContentHeaderComponent,
    ContentMainContentComponent
  }
};
</script>

<style>
</style>
