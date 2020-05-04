<template>
  <div>
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
          <b-form-input id="email" v-model="email" trim ></b-form-input>
          <span class="form-bar"></span>
          <label class="float-label">Email</label>
        </b-form-group>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginView"
};
</script>

<style>
</style>
-
