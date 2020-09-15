<template>
  <div class="page-header-breadcrumb">
    <b-breadcrumb class="breadcrumb-title">
      <b-breadcrumb-item :to="{name:'home'}">
        <feather type="home" size="13"></feather>
      </b-breadcrumb-item>

      <b-breadcrumb-item
        v-for="item in this.items"
        v-bind:key="item.id"
        :active=" item.active ? true : false "
      >{{item.text}}</b-breadcrumb-item>
    </b-breadcrumb>
  </div>
</template>

<script>
export default {
  name: "BreadCrumbComponent",
  props: {
    items: {
      type: Array,
      default: () =>  []
    }
  }
};
</script>

<style>
</style>
