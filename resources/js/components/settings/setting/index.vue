<template>
  <div>
    <content-header-component
      title="Configuración"
      subtitle="Toda la configuración básica"
      icon="settings"
      :listBreadcrumbs="listBreadcumbs"
    ></content-header-component>

    <content-main-content-component>
      <b-col sm="12" md="4">
        <div class="card">
          <div class="card-header">
            <h5>General</h5>
          </div>
          <div class="card-body">
            <form @submit="saveFrmGeneral" @reset="resetGeneral" validated novalidate>
              <b-form-group
                id="lbl-business-name"
                label="Empresa"
                label-for="txt-bussiness-name"
                label-size="sm"
              >
                <b-form-input
                  id="txt-bussiness-name"
                  v-model="frmGeneral.business_name.value"
                  required
                  placeholder="Nombre de la empresa"
                  size="sm"
                  autofocus
                  @change="saveItemConfig(frmGeneral.business_name,'savingBussinessName')"
                  :disabled="statesItemFrm.savingBussinessName || statesItemFrm.savingGeneralFrmConfig"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                id="lbl-business-address"
                label="Dirección"
                label-for="txt-bussiness-address"
                label-size="sm"
              >
                <b-form-input
                  id="txt-bussiness-address"
                  v-model="frmGeneral.business_address.value"
                  required
                  placeholder="Av. Francisco de Orellana, Guayaquil"
                  size="sm"
                  @change="saveItemConfig(frmGeneral.business_address,'savingBussinessAddress')"
                  :disabled="statesItemFrm.savingBussinessAddress || statesItemFrm.savingGeneralFrmConfig"
                ></b-form-input>
              </b-form-group>

              <b-form-row>
                <b-col sm="12" lg="6">
                  <b-form-group
                    id="lbl-business-phone"
                    label="Teléfono"
                    label-for="txt-bussiness-phone"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-bussiness-phone"
                      v-model="frmGeneral.business_phone.value"
                      required
                      placeholder="2195533"
                      size="sm"
                      @change="saveItemConfig(frmGeneral.business_phone,'savingBussinessPhone')"
                      :disabled="statesItemFrm.savingBussinessPhone || statesItemFrm.savingGeneralFrmConfig"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col sm="12" lg="6">
                  <b-form-group
                    id="lbl-business-email"
                    label="Correo Electrónico"
                    label-for="txt-bussiness-email"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-bussiness-email"
                      v-model="frmGeneral.business_email.value"
                      required
                      placeholder="info@micatering.com"
                      size="sm"
                      @change="saveItemConfig(frmGeneral.business_email,'savingBussinessEmail')"
                      :disabled="statesItemFrm.savingBussinessEmail || statesItemFrm.savingGeneralFrmConfig"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col cols="12">
                  <b-button type="submit" variant="primary" size="sm" class="custom-form-button">
                    <feather type="save" class="align-top" size="15"></feather>Guardar
                  </b-button>
                </b-col>
              </b-form-row>
            </form>
          </div>
        </div>
      </b-col>
      <!-- Conf General -->
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { SettingService } from "./SettingService";

export default {
  name: "SettingIndex",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent
  },
  data() {
    return {
      statesItemFrm: {
        savingBussinessName: false,
        savingBussinessAddress: false,
        savingBussinessPhone: false,
        savingBussinessEmail: false,
        savingGeneralFrmConfig: false
      },
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
        business_name: {},
        business_address: {},
        business_phone: {},
        business_email: {}
      }
    };
  },
  methods: {
    loadGeneralSettings() {
      SettingService.listServices("general").then(results => {
        results.map(item => {
          if (this.frmGeneral.hasOwnProperty(item.key)) {
            this.frmGeneral[item.key] = item;
          }
        });
      });
    },
    saveItemConfig(data, item) {
      this.statesItemFrm[item] = true;
      SettingService.saveItemConfig(data).then(result => {
        data = result;
        this.statesItemFrm[item] = false;
      });
    },
    saveFrmGeneral(e) {
      e.preventDefault();
      e.stopPropagation();
      this.statesItemFrm.savingGeneralFrmConfig = true;
      SettingService.saveAllForm(this.frmGeneral).then(result => {
        this.statesItemFrm.savingGeneralFrmConfig = false;
        this.frmGeneral = result;
      });
    },
    resetGeneral() {}
  },
  mounted() {
    this.loadGeneralSettings();
  }
};
</script>

