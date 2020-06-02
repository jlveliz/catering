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
            <h5>Lugares de Trabajo</h5>
          </div>
          <div class="card-block">
            <b-table-lite responsive striped hover :items="workplaces" :fields="fields" table-class="table-xs">
              <template v-slot:cell(name)="row">
                <b-link @click="showModal(row.item.id)">{{row.item.name}}</b-link>
              </template>
              <template v-slot:cell(action)="row">
                <b-button size="sm" @click="row.toggleDetails" class="mr-2">Details</b-button>
              </template>
            </b-table-lite>
          </div>
        </div>
      </b-col>
    </content-main-content-component>
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
          key: "action",
          label: "Acción"
        }
      ],
      workplaces: []
    };
  },
  methods: {
    loadWorkplaces() {
      WorkplaceService.listWorkplaces().then(
        result => (this.workplaces = result)
      );
    },
    showModal(id) {
        console.log(id);
    }
  },
  mounted() {
    return this.loadWorkplaces();
  }
};
</script>

<style>
</style>
