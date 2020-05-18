<template>
  <nav
    class="pcoded-navbar is-hover"
    navbar-theme="themelight1"
    active-item-theme="theme1"
    sub-item-theme="theme1"
    active-item-style="style1"
    pcoded-navbar-position="fixed"
  >
    <div class="pcoded-inner-navbar">
      <ul class="pcoded-item" item-border="true" item-border-style="none" subitem-border="true">
        <!-- <li class="pcoded-hasmenu is-hover" subitem-icon="style1" dropdown-icon="style1">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <i class="feather icon-sidebar"></i>
            </span>
            <span class="pcoded-mtext">Navigation</span>
          </a>
        </li>-->
        <li
          class="pcoded-hasmenu is-hover"
          subitem-icon="style1"
          dropdown-icon="style1"
          v-for="(menu, idx, key) in menus"
          v-bind="key"
        >
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <feather :type="menu.icon" class="icon-sidebar" size="14"></feather>
            </span>
            <span class="pcoded-mtext">{{menu.name}}</span>
            <feather type="chevron-down" class="icon-sidebar" size="12"></feather>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavbarMenuComponent",
  data() {
    return {
      menus: []
    };
  },
  methods: {
    async loadMenu() {
      const menus = await axios.get("/api/menus", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });
      return menus.data.data;
    }
  },
  created() {
    this.$store.dispatch("getMenus").then(result => (this.menus = result));
  }
};
</script>

<style>
</style>
