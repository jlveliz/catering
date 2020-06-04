<template>
  <div>
    <content-header-component
      title="Lugares de Trabajo"
      subtitle="Punto de trabajo donde laboran tus empleados"
      icon="map-pin"
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
                >Lugares de Trabajo</h5>
              </b-col>
              <b-col md="2" sm="12" class="text-center text-md-right text-sm-center">
                <b-button size="sm" variant="primary" @click="createWorkplace()">
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
              :items="workplaces"
              :fields="fields"
              table-class="table-xs"
            >
              <template v-slot:cell(name)="row">
                <b-link @click="editWorkplace(row.item.id)">{{row.item.name}}</b-link>
              </template>
              <template v-slot:cell(action)="row">
                <b-dropdown size="sm" variant="default">
                  <template v-slot:button-content>
                    <feather type="tool" size="15px" class="align-middle"></feather>
                  </template>
                  <b-dropdown-item @click="editWorkplace(row.item.id)">
                    <feather type="edit" size="15px" class="align-middle"></feather>Editar
                  </b-dropdown-item>
                  <b-dropdown-item v-if="row.item.num_employees == 0">
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
      @ok="saveFrmWorkplace"
      cancel-title="Cancelar"
      cancel-variant="outline-dark"
      :cancel-disabled="this.savingFrm"
      @hidden="closeModal"
    >
      <form @submit.stop.prevent="saveFrmWorkplace" validated novalidate>
        <b-form-row>
          <b-col sm="6" lg="4">
            <b-form-group
              id="lbl-model-code"
              label="Código*"
              label-for="txt-model-code"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-code"
                v-model="$v.model.code.$model"
                required
                placeholder="COD-1"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('code')"
                aria-describedby="txt-model-code-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-code-feedback"
                v-if="!$v.model.code.required"
              >Código requerido</b-form-invalid-feedback>
              <b-form-invalid-feedback
                id="txt-model-code-feedback"
                v-if="!$v.model.code.isUnique"
              >Código existente</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col sm="6" lg="8">
            <b-form-group
              id="lbl-model-name"
              label="Nombre*"
              label-for="txt-model-name"
              label-size="sm"
            >
              <b-form-input
                id="txt-model-name"
                v-model="$v.model.name.$model"
                required
                placeholder="Principal"
                size="sm"
                :disabled="savingFrm"
                :state="validateState('name')"
                aria-describedby="txt-model-name-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                id="txt-model-name-feedback"
                v-if="!$v.model.name.required"
              >Nombre requerido</b-form-invalid-feedback>
              <b-form-invalid-feedback
                id="txt-model-name-feedback"
                v-if="!$v.model.name.isUnique"
              >Nombre existente</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>

        <b-form-group id="lbl-address" label="Dirección" label-for="txt-address" label-size="sm">
          <b-form-input
            id="txt-address"
            v-model="$v.model.address.$model"
            required
            placeholder="Sur de la Ciudad 90"
            size="sm"
            :disabled="savingFrm"
            :state="validateState('address')"
            aria-describedby="txt-model-address-feedback"
          ></b-form-input>
          <b-form-invalid-feedback
            id="txt-model-address-feedback"
            v-if="!$v.model.address.required"
          >Dirección requerido</b-form-invalid-feedback>
        </b-form-group>
      </form>
    </b-modal>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import { Helpers } from "./../../../helpers";
import { WorkplaceService } from "./WorkplaceService";
import Vue from "vue";

export default {
  name: "WorkplaceIndex",
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
          text: "Lugares de trabajo",
          active: true
        }
      ],
      fields: [
        {
          key: "code",
          label: "Código",
          sortable: true
        },
        {
          key: "name",
          label: "Nombre",
          sortable: true
        },
        {
          key: "address",
          label: "Dirección",
          sortable: false
        },
        {
          key: "num_employees",
          label: "Num Empleados"
        },
        {
          key: "action",
          label: "Acción"
        }
      ],
      workplaces: [],
      model: {
        code: null,
        name: null,
        address: null
      },
      titleModal: "",
      savingFrm: false,
      frmValidation: {
        code: null,
        name: null,
        address: null
      },
      modalButtonSave: ""
    };
  },
  validations: {
    model: {
      code: {
        required,
        isUnique(value) {
          if (!value) return true;
          return new Promise(resolve => {
            setTimeout(() => {
              let params = {
                method: "unique",
                table: "workplaces",
                field: "name",
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
        required,
        isUnique(value) {
          if (!value) return true;
          return new Promise(resolve => {
            setTimeout(() => {
              let params = {
                method: "unique",
                table: "workplaces",
                field: "name",
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
      address: {
        required
      }
    }
  },
  methods: {
    loadWorkplaces() {
      WorkplaceService.listWorkplaces().then(
        result => (this.workplaces = result)
      );
    },
    resetFormCreateEdit() {
      this.model = {
        code: null,
        name: null,
        address: null
      };
      this.savingFrm = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    createWorkplace() {
      this.resetFormCreateEdit();
      this.$refs["create-edit-modal"].show();
      this.titleModal = "Crear Lugar de Trabajo";
    },
    editWorkplace(id) {
      this.resetFormCreateEdit();
      WorkplaceService.getWorkplace(id).then(result => {
        this.model = result;
        this.$refs["create-edit-modal"].show();
        this.titleModal = "Editar Lugar de Trabajo";
      });
    },
    closeModal() {
      this.$v.$reset();
      this.$refs["create-edit-modal"].hide();
    },
    makeToast(options) {
      this.$bvToast.toast(options.content, options);
    },
    saveFrmWorkplace(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.$v.model.$touch();
      if (this.$v.model.$anyError) {
        return;
      }
      this.savingFrm = true;
      let isUpdating = false;
      if (this.model.id) {
        isUpdating = true;
        var promise = WorkplaceService.updateWorkplace(this.model);
      } else {
        var promise = WorkplaceService.saveWorkplace(this.model);
      }

      promise
        .then(result => {
          if (isUpdating) {
            this.refreshListWorkplaces(result);
          } else {
            this.workplaces.push(result);
          }
          this.makeToast({
            content: !isUpdating
              ? "Área de trabajo guardada"
              : "Área de trabajo actualizada",
            title: "Atención",
            variant: "info"
          });
        })
        .catch(err => {
          this.makeToast({
            content: "No se pudo guardar el área de trabajo",
            title: "Atención",
            variant: "danger"
          });
        })
        .then(r => this.$refs["create-edit-modal"].hide());
    },
    refreshListWorkplaces(data) {
      let idx = this.workplaces.findIndex(el => el.id == data.id);
      if (idx) this.$set(this.workplaces, idx, data);
    },
    validateState(item) {
      const { $error } = this.$v.model[item];
      return $error ? false : null;
    }
  },
  mounted() {
    this.loadWorkplaces();
  }
};
</script>