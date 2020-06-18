<template>
  <div>
    <content-header-component
      title="usuarios"
      subtitle="Administra los usuarios dentro del sistema"
      icon="users"
      :listBreadcrumbs="listBreadcumbs"
    ></content-header-component>
    <content-main-content-component>
      <b-col cols="12">
        <div class="card">
          <div class="card-header">
            <b-row>
              <b-col md="10" sm="12">
                <h5
                  class="text-md-left text-sm-center text-center d-block d-block"
                >Listado de usuarios</h5>
              </b-col>
              <b-col md="2" sm="12" class="text-center text-md-right text-sm-center">
                <b-button size="sm" variant="primary" @click="createUser()">
                  <feather type="plus" class="align-middle" size="15px"></feather>Crear
                </b-button>
              </b-col>
            </b-row>
          </div>
          <div class="card-block">
            <b-table-lite
              responsive
              striped
              hover
              :items="users"
              :fields="fields"
              table-class="table-xs"
            >
              <template v-slot:cell(fullname)="row">
                <b-link @click="editWorkplace(row.item.id)">{{row.item.fullname}}</b-link>
              </template>

              <template v-slot:cell(role.name)="row">
                <span class="text-success font-weight-bold">{{row.item.role.name}}</span>
              </template>

              <template v-slot:cell(state)="row">
                <span
                  :class="{'text-success': row.item.state == 1 , 'text-warning':row.item.state == 0}"
                >{{row.item.state == 1 ? 'Activo' : 'Inactivo'}}</span>
              </template>

              <template v-slot:cell(action)="row">
                <b-dropdown size="sm" variant="default">
                  <template v-slot:button-content>
                    <feather type="tool" size="15px" class="align-middle"></feather>
                  </template>
                  <b-dropdown-item @click="editWorkplace(row.item.id)">
                    <feather type="edit" size="15px" class="align-middle"></feather>Editar
                  </b-dropdown-item>
                  <b-dropdown-item
                    v-if="row.item.role.name != 'Administrador'"
                    @click="deleteWorkplace(row.item,row.index)"
                  >
                    <feather type="delete" size="15px" class="align-middle"></feather>Eliminar
                  </b-dropdown-item>
                </b-dropdown>
              </template>
            </b-table-lite>
          </div>
        </div>
      </b-col>
    </content-main-content-component>

    <b-modal
      ref="create-edit-modal"
      :title="titleModal"
      button-size="sm"
      ok-title="Guardar"
      :ok-disabled="this.$v.model.$anyError || this.savingFrm"
      @ok="saveFrmUser"
      cancel-title="Cancelar"
      cancel-variant="outline-dark"
      :cancel-disabled="this.savingFrm"
      @hidden="closeModal"
    >
      <form @submit.stop.prevent="saveFrmUser" validated novalidate>
        <b-form-row>
          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-username"
              label="Nombre de Usuario*"
              label-for="txt-model-username"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-username"
                v-model="$v.model.username.$model"
                required
                placeholder="jbania"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('username')"
                aria-describedby="txt-model-username-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-username-feedback"
                v-if="!$v.model.username.required"
              >Nombre de usuario requerido</b-form-invalid-feedback>
              <b-form-invalid-feedback
                id="txt-model-username-feedback"
                v-if="!$v.model.username.isUnique"
              >Nombre de usuario existente</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-email"
              label="Email*"
              label-for="txt-model-email"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-email"
                v-model="$v.model.email.$model"
                required
                placeholder="info@mail.com"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('email')"
                aria-describedby="txt-model-email-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-email-feedback"
                v-if="!$v.model.email.required"
              >Correo electrónico requerido</b-form-invalid-feedback>
              <b-form-invalid-feedback
                id="txt-model-email-feedback"
                v-if="!$v.model.email.isUnique"
              >Correo electrónico existente existente</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>

        <b-form-row>
          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-name"
              label="Nombres*"
              label-for="txt-model-name"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-name"
                v-model="$v.model.name.$model"
                required
                placeholder="Hector Luis"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('name')"
                aria-describedby="txt-model-name-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-name-feedback"
                v-if="!$v.model.name.required"
              >Nombres requeridos</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-lastname"
              label="Apellidos*"
              label-for="txt-model-lastname"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-lastname"
                v-model="$v.model.lastname.$model"
                required
                placeholder="Zambrano Carransa"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('lastname')"
                aria-describedby="txt-model-lastname-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-lastname-feedback"
                v-if="!$v.model.lastname.required"
              >Apellido requerido</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>

        <b-form-row>
          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-password"
              label="Contraseña*"
              label-for="txt-model-password"
              label-size="sm"
            >
              <b-form-input
                type="password"
                id="txt-model-password"
                v-model="$v.model.password.$model"
                required
                size="sm"
                :disabled="savingFrm"
                :state="validateState('password')"
                aria-describedby="txt-model-password-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-password-feedback"
                v-if="!$v.model.password.required"
              >Contraseña requerida</b-form-invalid-feedback>
              <b-form-invalid-feedback
                id="txt-model-password-feedback"
                v-if="!$v.model.password.minLength"
              >Debe tener al menos 6 caracteres</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-password-confirmation"
              label="Confirmar contraseña*"
              label-for="txt-model-password-confirmation"
              label-size="sm"
            >
              <b-form-input
                type="password"
                id="txt-model-password-confirmation"
                v-model="$v.model.password_confirmation.$model"
                required
                size="sm"
                :disabled="savingFrm"
                :state="validateState('password_confirmation')"
                aria-describedby="txt-model-password-confirmation-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-password-confirmation-feedback"
                v-if="!$v.model.password_confirmation.required"
              >Contraseñas deben ser iguales</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>

        <b-form-row>
          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-state"
              label="Estado*"
              label-for="select-model-state"
              label-size="sm"
            >
              <b-form-select
                v-model="$v.model.state.$model"
                :options="stateOptions"
                size="sm"
                id="select-model-state"
              ></b-form-select>
            </b-form-group>
          </b-col>

          <b-col sm="6" lg="6">
            <b-form-group
              id="lbl-model-role"
              label="Rol*"
              label-for="select-model-role"
              label-size="sm"
            >
              <b-form-select
                v-model="$v.model.role_id.$model"
                :options="roles"
                size="sm"
                id="select-model-role"
              ></b-form-select>
            </b-form-group>
          </b-col>
        </b-form-row>
      </form>
    </b-modal>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { validationMixin } from "vuelidate";
import { required, sameAs, minLength } from "vuelidate/lib/validators";
import { Helpers } from "./../../../helpers";
import { UserService } from "./UserService";
import Vue from "vue";
import swal from "sweetalert";

export default {
  name: "UsersIndex",
  mixins: [validationMixin],
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent
  },
  data() {
    return {
      listBreadcumbs: [
        {
          text: "Configuración"
        },
        {
          text: "Usuarios",
          active: true
        }
      ],
      fields: [
        {
          key: "fullname",
          label: "Nombres",
          sortable: true
        },
        {
          key: "email",
          label: "Email"
        },
        {
          key: "role.name",
          label: "Rol"
        },
        {
          key: "state",
          label: "Estado"
        },
        {
          key: "action",
          label: "Acción"
        }
      ],
      users: [],
      model: {
        username: null,
        name: null,
        lastname: null,
        email: null,
        password: null,
        password_confirmation: null,
        role_id: null,
        state: 0
      },
      titleModal: "",
      savingFrm: false,
      frmValidation: {
        username: null,
        name: null,
        lastname: null,
        email: null,
        password: null,
        password_confirmation: null,
        role_id: null,
        state: 0
      },
      modalButtonSave: "",
      stateOptions: [
        {
          value: 1,
          text: "Activo"
        },
        {
          value: 0,
          text: "Inactivo"
        }
      ]
    };
  },
  validations: {
    model: {
      username: {
        required,
        isUnique(value) {
          if (!value) return true;
          return new Promise(resolve => {
            setTimeout(() => {
              let params = {
                method: "unique",
                table: "users",
                field: "username",
                value
              };

              if (this.model.id) params.id = this.model.id;

              let exists = Helpers.validateUnique(params);
              exists.then(data => {
                resolve(data.data);
              });
            }, 3000);
          });
        }
      },
      email: {
        required,
        isUnique(value) {
          if (!value) return true;
          return new Promise(resolve => {
            setTimeout(() => {
              let params = {
                method: "unique",
                table: "users",
                field: "email",
                value
              };

              if (this.model.id) params.id = this.model.id;

              let exists = Helpers.validateUnique(params);
              exists.then(data => {
                resolve(data.data);
              });
            }, 3000);
          });
        }
      },
      name: {
        required
      },
      lastname: {
        required
      },
      password: {
        required,
        minLength: minLength(6)
      },
      password_confirmation: {
        sameAsPassword: sameAs("password")
      },
      role_id: {
        required
      },
      state: {
        required
      }
    }
  },
  methods: {
    loadusers() {
      UserService.listUsers().then(result => (this.users = result));
    },
    resetFormCreateEdit() {
      this.model = {
        username: null,
        name: null,
        lastname: null,
        email: null,
        password: null,
        password_confirmation: null,
        role_id: null,
        state: 0
      };
      this.savingFrm = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    createUser() {
      this.resetFormCreateEdit();
      this.$refs["create-edit-modal"].show();
      this.titleModal = "Crear Usuario";
    },
    editWorkplace(id) {
      this.resetFormCreateEdit();
      UserService.getUser(id).then(result => {
        this.model = result;
        this.$refs["create-edit-modal"].show();
        this.titleModal = "Editar Usuario";
      });
    },
    deleteWorkplace(item, idx) {
      swal({
        title: "Atención",
        text:
          "Deseas eliminar " +
          item.fullname +
          "?. Una vez eliminado no podrá recuperarlo",
        icon: "warning",
        dangerMode: true,
        buttons: true
      })
        .then(() => {
          let promise = UserService.removeUser(item.id);
          promise.then(result => {
            this.$delete(this.users, idx);
            this.makeToast({
              content: "Usuario eliminado",
              title: "Atención",
              variant: "info"
            });
          });
        })
        .catch(() => {
          this.makeToast({
            content: "No se pudo eliminar el Usuario",
            title: "Atención",
            variant: "danger"
          });
        });
    },
    closeModal() {
      this.$v.$reset();
      this.$refs["create-edit-modal"].hide();
    },
    makeToast(options) {
      this.$bvToast.toast(options.content, options);
    },
    saveFrmUser(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.$v.model.$touch();
      if (this.$v.model.$anyError) {
        return;
      }
      this.savingFrm = true;
      let isUpdating = false;
      if (this.model.id) {
        isUpdating = true;
        var promise = UserService.updateWorkplace(this.model);
      } else {
        var promise = UserService.saveWorkplace(this.model);
      }

      promise
        .then(result => {
          if (isUpdating) {
            this.refreshListusers(result);
          } else {
            this.users.push(result);
          }
          this.makeToast({
            content: !isUpdating ? "Usuario guardado" : "Usuario actualizado",
            title: "Atención",
            variant: "info"
          });
        })
        .catch(err => {
          this.makeToast({
            content: "No se pudo guardar el usuario",
            title: "Atención",
            variant: "danger"
          });
        })
        .then(r => this.$refs["create-edit-modal"].hide());
    },
    refreshListusers(data) {
      let idx = this.users.findIndex(el => el.id == data.id);
      if (idx > -1) this.$set(this.users, idx, data);
    },
    validateState(item) {
      const { $error } = this.$v.model[item];
      return $error ? false : null;
    }
  },
  mounted() {
    this.loadusers();
  }
};
</script>