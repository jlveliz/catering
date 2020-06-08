<template>
  <div>
    <content-header-component
      title="Contabilidad"
      subtitle="Configuración disponible para la facturación"
      icon="file-text"
      :listBreadcrumbs="listBreadcumbs"
    ></content-header-component>

    <content-main-content-component>
      <!-- Conf Metodos de pago -->
      <b-col cols="12">
        <div class="card">
          <div class="card-header">
            <h5>Facturación</h5>
          </div>
          <div class="card-block">
            <form @submit.stop.prevent="saveFrmInvoice" validated novalidate>
              <b-form-row>
                <b-col sm="12" md="4">
                  <b-form-group
                    id="lbl-legal-representant"
                    label="Representante Legal"
                    label-for="txt-legal-representant"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-legal-representant"
                      v-model="$v.frmInvoice.legal_representant.value.$model"
                      required
                      placeholder="Alejandro Falconi"
                      size="sm"
                      @change="saveItemConfig(frmInvoice.legal_representant,'savingLegalRepresentant')"
                      :disabled="statesItemFrm.savingLegalRepresentant || statesItemFrm.savingInvoiceFrmConfig"
                      :state="validateState('frmInvoice.legal_representant')"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col sm="12" md="4">
                  <b-form-group
                    id="lbl-tax-identification"
                    label="RUC"
                    label-for="txt-tax-identification"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-tax-identification"
                      v-model="$v.frmInvoice.tax_identification.value.$model"
                      required
                      placeholder="0926894544001"
                      size="sm"
                      @change="saveItemConfig(frmInvoice.tax_identification,'savingTaxIdentification')"
                      :disabled="statesItemFrm.savingTaxIdentification || statesItemFrm.savingInvoiceFrmConfig"
                      :state="validateState('frmInvoice.tax_identification')"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col sm="12" md="4">
                  <b-form-group
                    id="lbl-invoice-init-sequential"
                    label="Sencuencial Inical en Facturas"
                    label-for="txt-invoice-init-sequential"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-invoice-init-sequential"
                      v-model="$v.frmInvoice.invoice_init_sequential.value.$model"
                      required
                      placeholder="0926894544001"
                      size="sm"
                      @change="saveItemConfig(frmInvoice.invoice_init_sequential,'savingInvoiceInitSequential')"
                      :disabled="statesItemFrm.savingInvoiceInitSequential || statesItemFrm.savingInvoiceFrmConfig"
                      :state="validateState('frmInvoice.invoice_init_sequential')"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-form-row>
            </form>
          </div>
        </div>
      </b-col>
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../../layouts/parts/ContentMainContentComponent";
import { AccountingService } from "./AccountingService";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
export default {
  name: "AccountingIndex",
  mixins: [validationMixin],
  components: { ContentHeaderComponent, ContentMainContentComponent },
  data() {
    return {
      listBreadcumbs: [
        {
          text: "Configuración"
        },
        {
          text: "Contabilidad",
          active: true
        }
      ],
      statesItemFrm: {
        savingLegalRepresentant: false,
        savingTaxIdentification: false,
        savingInvoiceFrmConfig: false,
        savingInvoiceInitSequential: false
      },
      frmInvoice: {
        legal_representant: {},
        tax_identification: {},
        invoice_init_sequential: {}
      }
    };
  },
  validations: {
    frmInvoice: {
      legal_representant: {
        value: {
          required
        }
      },
      tax_identification: {
        value: {
          required
        }
      },
      invoice_init_sequential: {
        value: {
          required
        }
      }
    }
  },
  methods: {
    saveItemConfig() {},

    loadInvoiceConfig(type, formObject) {
      AccountingService.listConfig(type).then(results => {
        results.map(item => {
          if (formObject.hasOwnProperty(item.key)) {
            formObject[item.key] = item;
          }
        });
      });
    },

    validateState(item) {
      item = item.split(".");
      const { $error } = this.$v[item[0]][item[1]].value;
      return $error ? false : null;
    },
    makeToast(options) {
      this.$bvToast.toast(options.content, options);
    }
  },
  mounted() {
    this.loadInvoiceConfig("invoice", this.frmInvoice);
  }
};
</script>

<style>
</style>