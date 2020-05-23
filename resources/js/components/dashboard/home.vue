<template>
  <div>
    <content-header-component title="Escritorio" subtitle="Muestra un resumen de todo"></content-header-component>

    <content-main-content-component>
      <div class="card">
        <div class="card-header">Dashboard</div>
      </div>
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../layouts/parts/ContentMainContentComponent";
export default {
  name: "Dashboard",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent
  }
};
</script>

