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
        <b-link
            :to="{name:menu.route}"
            :class="{'pcoded-hasmenu':menu.children.length > 0}"
            router-tag="li"
            class="is-hover"
            subitem-icon="style1"
            dropdown-icon="style1"
            v-for="menu in menus"
            v-bind:key="menu.id"
            active-class='active'>
                <a class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <feather :type="menu.icon" class="icon-sidebar" size="14"></feather>
                    </span>
                    <span class="pcoded-mtext">{{menu.name}}</span>
                    <feather v-if="menu.children.length > 0" type="chevron-down" class="icon-sidebar" size="12"></feather>
                </a>
                <ul v-if="menu.children.length > 0" class="pcoded-submenu">
                    <li v-for="children in menu.children" v-bind:key="children.id">
                        {{children.name}}
                    </li>
                </ul>
        </b-link>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavbarMenuComponent",
  data() {
    return {
      menus: [],
      isActive:false
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
