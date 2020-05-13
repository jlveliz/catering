<template>
  <div>
    <b-form class="md-float-material form-material" @submit="doLogin">
      <div class="text-center">
        <img src="./../../../images/svg/logo.svg" class="img-fluid login-logo-img" />
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
          <b-alert :show="hasError" fade dismissible variant="danger" class="background-danger">{{error}}</b-alert>

          <b-form-group class="form-primary" label-for="email">
            <b-form-input
              id="email"
              ref="email"
              v-model="form.email"
              trim
              required
              :class="{'fill': fStates.email || form.email}"
              @focus="fStates.email = true"
              @blur="fStates.email = false"
              :disabled="fStates.isSubmiting"
              autofocus
            ></b-form-input>
            <span class="form-bar"></span>
            <label class="float-label">Email</label>
          </b-form-group>
          <b-form-group class="form-primary" label-for="password">
            <b-form-input
              type="password"
              id="password"
              ref="password"
              v-model="form.password"
              trim
              required
              :class="{'fill': fStates.password || form.password}"
              @focus="fStates.password = true"
              @blur="fStates.password = false"
              :disabled="fStates.isSubmiting"
            ></b-form-input>
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
              <b-button :disabled="fStates.isSubmiting" type="submit" variant="primary" block>
                <span v-if="!fStates.isSubmiting">INGRESAR</span> 
                <feather v-if="fStates.isSubmiting" type="loader" animation="spin" animation-speed="fast"></feather>
              </b-button>
            </b-col>
          </b-row>
        </div>
      </div>
    </b-form>
  </div>
</template>

<script>


export default {
  name: "LoginView",
  data() {
    return {
      form: {
        email: "",
        password: "",
        remember: false
      },
      error: "",
      hasError: false,
      fStates: {
        email: false,
        password: false,
        isSubmiting: false
      }
    };
  },
 
  methods: {
    setFocusPassword() {
      this.$refs.password.$el.focus();
    },
    doLogin(e) {
      e.preventDefault();
      e.stopPropagation();
      this.fStates.isSubmiting = true;
      this.hasError = false;
      let promise = this.$store.dispatch("retrieveToken", {
        email: this.form.email,
        password: this.form.password,
        remember: this.form.remember
      });
      promise
        .then(response => {
          this.$store.commit("SET_LAYOUT", "app-layout");
          this.$router.push({ name: "home" });
        })
        .catch(exception => {
          let response = exception.response;
          let status = response.status;
          if (status == 422) {
            this.error = "Usuario o Clave erroneo";
            this.form.password = "";
            this.form.remember = false;
          } else {
            this.error = response.data.message;
          }
          this.hasError = true;
          this.setFocusPassword()
          
        })
        .then( () => this.fStates.isSubmiting = false )
    }
  }
};
</script>

<style lang="scss" scoped>
  .login-logo-img{
    width: 8%;
  }
</style>