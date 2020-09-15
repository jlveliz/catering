<template>
  <div class="page-header card">
    <b-row class="align-items-end">
      <b-col lg="8">
        <div class="page-header-title">
          <feather class="bg-c-blue mr-3" :type="this.icon"></feather>
          <div class="d-inline">
            <h5>{{this.title}}</h5>
            <span>{{this.subtitle}}</span>
          </div>
        </div>
      </b-col>

      <b-col lg="4">
        <breadcrumb-component :items="listBreadcrumbs"></breadcrumb-component>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import BreadcrumbComponent from "./BreadcrumbComponent";
export default {
  name: "ContentHeaderComponent",
  components: { BreadcrumbComponent },
  props: {
    title: {
      type: String,
      default: ""
    },
    subtitle: {
      type: String,
      default: ""
    },
    icon: {
      type: String,
      default: "home"
    },
    listBreadcrumbs: {
        type: Array,
        default: () => []
    }
  }
};
</script>

<style >
.page-header.card .page-header-title i, .page-header.card .page-header-title svg {
  margin-right: 0px !important;
}
</style>
