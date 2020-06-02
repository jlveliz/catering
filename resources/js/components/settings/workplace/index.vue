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
                    <feather type="edit" size="15px" class="align-middle"></feather> Editar
                  </b-dropdown-item>
                  <b-dropdown-item v-if="row.item.num_employees == 0">
                    <feather type="delete" size="15px" class="align-middle"></feather> Eliminar
                  </b-dropdown-item>
                </b-dropdown>
              </template>
            </b-table-lite>
          </div>
        </div>
      </b-col>
    </content-main-content-component>

    <b-modal ref="create-edit-modal" :title="titleModal">
      <div class="d-block text-center">
        <h3>Hello From My Modal!</h3>
      </div>
      <b-button class="mt-3" variant="outline-danger" block>Close Me</b-button>
      <b-button class="mt-2" variant="outline-warning" block>Toggle Me</b-button>
    </b-modal>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { WorkplaceService } from "./WorkplaceService";

export default {
  name: "WorkplaceIndex",
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
      titleModal: ""
    };
  },
  methods: {
    loadWorkplaces() {
      WorkplaceService.listWorkplaces().then(
        result => (this.workplaces = result)
      );
    },
    createWorkplace() {
      this.$refs["create-edit-modal"].show();
      this.titleModal = "Crear Lugar de Trabajo";
    },
    editWorkplace(id) {
      this.$refs["create-edit-modal"].show();
      this.titleModal = "Editar Lugar de Trabajo";
    }
  },
  mounted() {
    return this.loadWorkplaces();
  }
};
</script>

<style>
</style>
