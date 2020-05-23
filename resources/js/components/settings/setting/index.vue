<template>
  <div>
    <content-header-component
      title="Configuracion"
      subtitle="Toda la configuracion basica"
      icon="settings"
      :listBreadcrumbs="listBreadcumbs"
    ></content-header-component>

    <content-main-content-component>
      <b-col sm="12">
        <div class="card">
          <div class="card-header">
            <h5>Configuración</h5>
          </div>
          <div class="card-body">
            <b-tabs class="md-tabs" content-class="mt-2">
              <b-tab title="Generales" title-item-class="font-weight-bold">
                <form @submitt="saveGeneral" @reset="resetGeneral" validated novalidate>
                  <b-form-group
                    id="lbl-business-name"
                    label="Empresa"
                    label-for="txt-bussiness-name"
                    label-cols-sm="2"
                  >
                    <b-form-input
                      id="txt-bussiness-name"
                      v-model="frmGeneral.business_name"
                      required
                      placeholder="Nombre de la empresa"
                      autofocus
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    id="lbl-business-address"
                    label="Dirección"
                    label-for="txt-bussiness-address"
                    label-cols-sm="2"
                  >
                    <b-form-input
                      id="txt-bussiness-address"
                      v-model="frmGeneral.business_address"
                      required
                      placeholder="Av. Francisco de Orellana, Guayaquil"
                    ></b-form-input>
                  </b-form-group>

                  <b-form-row>
                    <b-col sm="12" lg="6">
                      <b-form-group
                        id="lbl-business-phone"
                        label="Teléfono"
                        label-for="txt-bussiness-phone"
                        label-cols-sm="2"
                        label-cols-md="4"
                      >
                        <b-form-input
                          id="txt-bussiness-phone"
                          v-model="frmGeneral.business_phone"
                          required
                          placeholder="2195533"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col sm="12" lg="6">
                      <b-form-group
                        id="lbl-business-email"
                        label="Correo Electrónico"
                        label-for="txt-bussiness-email"
                        label-cols-sm="2"
                        label-cols-md="4"
                      >
                        <b-form-input
                          id="txt-bussiness-email"
                          v-model="frmGeneral.email"
                          required
                          placeholder="info@micatering.com"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-form-row>

                  <b-form-row>
                    <b-col col="12">
                      <b-button type="submit" variant="primary" size="sm" class="custom-form-button">
                        <!-- <feather type="save"></feather> -->
                        Guardar
                      </b-button>
                    </b-col>
                  </b-form-row>
                </form>
              </b-tab>
              <b-tab title="Servicios" title-item-class="font-weight-bold">contenido servicios</b-tab>
              <b-tab title="Medidas" title-item-class="font-weight-bold">contenido medidas</b-tab>
            </b-tabs>
          </div>
        </div>
      </b-col>
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
export default {
  name: "SettingIndex",
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
          text: "Configuración",
          active: true
        }
      ],
      frmGeneral: {
        business_name: ""
      }
    };
  },
  methods: {
    saveGeneral() {},
    resetGeneral() {}
  }
};
</script>

