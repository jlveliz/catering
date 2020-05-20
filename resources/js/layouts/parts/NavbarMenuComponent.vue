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
          v-for="(menu,index) in menus"
          v-bind:key="menu.id"
          :to="{name: menu.route ? menu.route : '#'}"
          :class="{'pcoded-hasmenu':menu.children.length > 0, 'pcoded-trigger': isActive == index}"
          router-tag="li"
          class="is-hover"
          subitem-icon="style1"
          dropdown-icon="style1"
          @mouseover="menu.children.length > 0 ? isActive = index : isActive = null"
          @mouseleave="isActive = null"
        >
          <a class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <feather :type="menu.icon" class="icon-sidebar" size="14"></feather>
            </span>
            <span class="pcoded-mtext">{{menu.name}}</span>
            <feather
              v-if="menu.children.length > 0"
              :type="isActive == index ?  'chevron-down' : 'chevron-right'"
              size="12"
            ></feather>
          </a>

          <!-- Children -->
          <ul v-if="menu.children.length > 0" class="pcoded-submenu">
            <b-link
              v-for="children in menu.children"
              v-bind:key="children.id"
              router-tag="li"
              :to="{name:children.route}"
            >
              <a class="waves-effect waves-dark">
                  <feather type="chevron-right" size="12"></feather>
                  <span class="pcoded-mtext">{{children.name}}</span>
                </a>
            </b-link>
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
      isActive:null
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
  },
  mounted() {
      console.log(this.$store.getters.getRoutes);
  }
};
</script>
