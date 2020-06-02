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
          <div class="card-block">
            <form @submit.stop.prevent="saveFrmGeneral" validated novalidate>
              <b-form-group
                id="lbl-business-name"
                label="Empresa"
                label-for="txt-bussiness-name"
                label-size="sm"
              >
                <b-form-input
                  id="txt-bussiness-name"
                  v-model="$v.frmGeneral.business_name.value.$model"
                  required
                  placeholder="Nombre de la empresa"
                  size="sm"
                  autofocus
                  @change="saveItemConfig(frmGeneral.business_name,'savingBussinessName')"
                  :disabled="statesItemFrm.savingBussinessName || statesItemFrm.savingGeneralFrmConfig"
                  :state="validateState('frmGeneral.business_name')"
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
                  v-model="$v.frmGeneral.business_address.value.$model"
                  required
                  placeholder="Av. Francisco de Orellana, Guayaquil"
                  size="sm"
                  @change="saveItemConfig(frmGeneral.business_address,'savingBussinessAddress')"
                  :disabled="statesItemFrm.savingBussinessAddress || statesItemFrm.savingGeneralFrmConfig"
                  :state="validateState('frmGeneral.business_address')"
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
                      v-model="$v.frmGeneral.business_phone.value.$model"
                      required
                      placeholder="2195533"
                      size="sm"
                      @change="saveItemConfig(frmGeneral.business_phone,'savingBussinessPhone')"
                      :disabled="statesItemFrm.savingBussinessPhone || statesItemFrm.savingGeneralFrmConfig"
                      :state="validateState('frmGeneral.business_phone')"
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
                      v-model="$v.frmGeneral.business_email.value.$model"
                      required
                      placeholder="info@micatering.com"
                      size="sm"
                      @change="saveItemConfig(frmGeneral.business_email,'savingBussinessEmail')"
                      :disabled="statesItemFrm.savingBussinessEmail || statesItemFrm.savingGeneralFrmConfig"
                      :state="validateState('frmGeneral.business_email')"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col cols="12">
                  <b-button
                    type="submit"
                    variant="primary"
                    size="sm"
                    class="custom-form-button"
                    :disabled="$v.frmGeneral.$invalid"
                  >
                    <feather type="save" class="align-top" size="15"></feather>Guardar
                  </b-button>
                </b-col>
              </b-form-row>
            </form>
          </div>
        </div>
      </b-col>
      <!-- Conf General -->

      <b-col sm="12" md="4">
        <div class="card">
          <div class="card-header">
            <h5>Servicios</h5>
          </div>
          <div class="card-body">
            <form @submit.stop.prevent="saveFrmServices" validated novalidate>
              <b-form-row>
                <b-col sm="12" lg="12">
                  <b-form-group label="Atención">
                    <b-form-checkbox
                      v-model="$v.frmService.monday_to_friday.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.monday_to_friday,'savingMondayToFriday')"
                      :disabled="statesItemFrm.savingMondayToFriday || statesItemFrm.savingServiceFrmConfig"
                    >Lunes a Viernes</b-form-checkbox>
                    <b-form-checkbox
                      v-model="$v.frmService.monday_to_sunday.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.monday_to_sunday,'savingMondayToSunday')"
                      :disabled="statesItemFrm.savingMondayToSunday || statesItemFrm.savingServiceFrmConfig"
                    >Lunes a Domingo</b-form-checkbox>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col sm="12" lg="12">
                  <b-form-group label="Desayunos">
                    <b-form-checkbox
                      v-model="$v.frmService.breakfast.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.breakfast,'savingBreakfast')"
                      :disabled="statesItemFrm.savingBreakfast || statesItemFrm.savingServiceFrmConfig"
                    >Normal</b-form-checkbox>
                    <b-form-checkbox
                      v-model="$v.frmService.dietary_breakfast.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.dietary_breakfast,'savingDietaryBreakfast')"
                      :disabled="statesItemFrm.savingDietaryBreakfast || statesItemFrm.savingServiceFrmConfig"
                    >Dieta</b-form-checkbox>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col sm="12" lg="12">
                  <b-form-group label="Almuerzos">
                    <b-form-checkbox
                      v-model="$v.frmService.lunch.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.lunch,'savingLunch')"
                      :disabled="statesItemFrm.savingLunch || statesItemFrm.savingServiceFrmConfig"
                    >Normal</b-form-checkbox>

                    <b-form-checkbox
                      v-model="$v.frmService.dietary_lunch.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.dietary_lunch,'savingDietaryLunch')"
                      :disabled="statesItemFrm.savingDietaryLunch || statesItemFrm.savingServiceFrmConfig"
                    >Dieta</b-form-checkbox>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col sm="12" lg="12">
                  <b-form-group label="Cenas">
                    <b-form-checkbox
                      v-model="$v.frmService.dinner.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.dinner,'savingDinner')"
                      :disabled="statesItemFrm.savingDinner || statesItemFrm.savingServiceFrmConfig"
                    >Normal</b-form-checkbox>

                    <b-form-checkbox
                      v-model="$v.frmService.dietary_dinner.value.$model"
                      value="yes"
                      unchecked-value="no"
                      inline
                      @change="saveItemConfig(frmService.dietary_dinner,'savingDietaryDinner')"
                      :disabled="statesItemFrm.savingDietaryDinner || statesItemFrm.savingServiceFrmConfig"
                    >Dieta</b-form-checkbox>
                  </b-form-group>
                </b-col>
              </b-form-row>
            </form>
          </div>
        </div>
      </b-col>
      <!-- Conf General -->

      <b-col sm="12" md="4">
        <div class="card">
          <div class="card-header">
            <h5>Medidas</h5>
          </div>
          <div class="card-body">
            <form @submit.stop.prevent="saveFrmServices" validated novalidate>
              <b-form-row>
                <b-form-group label="Pesos">
                  <b-form-radio-group v-model="$v.frmMeasure.weight.value.$model" @change="saveItemConfig(frmMeasure.weight,'savingWeight')"  :disabled="statesItemFrm.savingWeight">
                    <b-form-radio value="libra">Libra(s)</b-form-radio>
                    <b-form-radio value="kilo">Kilo(s)</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
              </b-form-row>
            </form>
          </div>
        </div>
      </b-col>
      <!-- Conf de Pesos -->
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import { SettingService } from "./SettingService";

export default {
  name: "SettingIndex",
  mixins: [validationMixin],
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
        savingGeneralFrmConfig: false,
        savingMondayToFriday: false,
        savingMondayToSunday: false,
        savingBreakfast: false,
        savingDietaryBreakfast: false,
        savingLunch: false,
        savingDietaryLunch: false,
        savingDinner: false,
        savingDietaryDinner: false,
        savingServiceFrmConfig: false,
        savingWeight: false
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
      },
      frmService: {
        monday_to_friday: {},
        monday_to_sunday: {},
        breakfast: {},
        dietary_breakfast: {},
        lunch: {},
        dietary_lunch: {},
        dinner: {},
        dietary_dinner: {}
      },
      frmMeasure: {
        weight: {}
      }
    };
  },
  methods: {
    loadSettings(type, formObject) {
      SettingService.listConfig(type).then(results => {
        results.map(item => {
          if (formObject.hasOwnProperty(item.key)) {
            formObject[item.key] = item;
          }
        });
      });
    },
    makeToast(options) {
      this.$bvToast.toast(options.content, options);
    },
    validateState(item) {
      item = item.split(".");
      const { $error } = this.$v[item[0]][item[1]].value;
      return $error ? false : null;
    },
    saveItemConfig(data, item) {
      if (!data.value) return false;
      this.statesItemFrm[item] = true;
      SettingService.saveItemConfig(data)
        .then(result => {
          data = result;
          this.statesItemFrm[item] = false;
          this.makeToast({
            content: "Configuración Guardada",
            title: "Atención",
            variant: "info"
          });
        })
        .catch(err => {
          this.statesItemFrm[item] = false;
        })
        .then(always => (this.statesItemFrm[item] = false));
    },
    saveFrmGeneral(e) {
      if (this.$v.frmGeneral.$invalid) return false;
      this.statesItemFrm.savingGeneralFrmConfig = true;
      SettingService.saveAllForm(this.frmGeneral).then(result => {
        this.statesItemFrm.savingGeneralFrmConfig = false;
        this.frmGeneral = result;
        this.makeToast({
          content: "Configuración General Guardada",
          title: "Atención",
          variant: "info"
        });
      });
    },
    saveFrmServices() {
      if (this.$v.frmService.$invalid) return false;
      this.statesItemFrm.savingServiceFrmConfig = true;
      SettingService.saveAllForm(this.frmService).then(result => {
        this.statesItemFrm.savingServiceFrmConfig = false;
        this.frmService = result;
        this.makeToast({
          content: "Configuración de Servicios Guardada",
          title: "Atención",
          variant: "info"
        });
      });
    }
  },
  validations: {
    frmGeneral: {
      business_name: {
        value: {
          required
        }
      },
      business_address: {
        value: {
          required
        }
      },
      business_phone: {
        value: {
          required
        }
      },
      business_email: {
        value: {
          required
        }
      }
    },

    frmService: {
      monday_to_friday: {
        value: {
          required
        }
      },
      monday_to_sunday: {
        value: {
          required
        }
      },
      breakfast: {
        value: {
          required
        }
      },
      dietary_breakfast: {
        value: {
          required
        }
      },
      lunch: {
        value: {
          required
        }
      },
      dietary_lunch: {
        value: {
          required
        }
      },
      dinner: {
        value: {
          required
        }
      },
      dietary_dinner: {
        value: {
          required
        }
      }
    },
    frmMeasure: {
      weight: {
        value: {
          required
        }
      }
    }
  },
  mounted() {
    this.loadSettings("general", this.frmGeneral);
    this.loadSettings("service", this.frmService);
    this.loadSettings("measure", this.frmMeasure);
  }
};
</script>

