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
        <li class="pcoded-hasmenu is-hover" subitem-icon="style1" dropdown-icon="style1">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <i class="feather icon-sidebar"></i>
            </span>
            <span class="pcoded-mtext">Navigation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavbarMenuComponent",
  created(){
      console.log('hola');
  },
  mounted(){
      console.log('montado');

  }
};
</script>

<style>
</style>
