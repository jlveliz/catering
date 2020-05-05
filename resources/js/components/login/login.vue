<template>
  <div>
    <b-form class="md-float-material form-material" @submit="doLogin">
      <div class="text-center">
        <h6>Catering</h6>
      </div>
      <div class="card auth-box">
        <div class="card-block">
          <b-row class="m-b-2">
            <b-col md="12">
              <h3 class="text-center txt-primary">Ingreso</h3>
            </b-col>
            <b-col md="12">
              <p class="text-muted text-center p-b-5">Ingrese su correo y contraseña</p>
            </b-col>
          </b-row>
          <b-form-group class="form-primary" label-for="email">
            <b-form-input id="email" v-model="form.email" trim></b-form-input>
            <span class="form-bar"></span>
            <label class="float-label">Email</label>
          </b-form-group>
          <b-form-group class="form-primary" label-for="password">
            <b-form-input type="password" id="password" v-model="form.password" trim></b-form-input>
            <span class="form-bar"></span>
            <label class="float-label">Contraseña</label>
          </b-form-group>

          <b-row class="m-t-5 text-left">
            <b-col>
              <b-form-checkbox id="remember" name="remember" v-model="form.remember">Recordarme</b-form-checkbox>
            </b-col>
          </b-row>

          <b-row class="m-t-30">
            <b-col md="12">
              <b-button type="submit" variant="primary" block>INGRESAR</b-button>
            </b-col>
          </b-row>
        </div>
      </div>
    </b-form>
  </div>
</template>

<script>

import Auth from './../../services/auth';


export default {
  name: "LoginView",
  data() {
    return {
      form: {
        email: "",
        password: "",
        remember: false
      }
    };
  },
  methods:{
    doLogin(e){
      e.preventDefault();
      e.stopPropagation();
      
      debugger
      (new Auth()).login(this.form.email,this.form.password,this.form.remember)
    }
  }
};
</script>

<style>
</style>
-
