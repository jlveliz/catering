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

                <b-col sm="12" md="3">
                  <b-form-group
                    id="lbl-invoice-init-sequential"
                    label="Sencuencial en Facturas"
                    label-for="txt-invoice-init-sequential"
                    label-size="sm"
                  >
                    <b-form-input
                      id="txt-invoice-init-sequential"
                      v-model="$v.frmInvoice.invoice_init_sequential.value.$model"
                      required
                      placeholder="1"
                      size="sm"
                      @change="saveItemConfig(frmInvoice.invoice_init_sequential,'savingInvoiceInitSequential')"
                      :disabled="statesItemFrm.savingInvoiceInitSequential || statesItemFrm.savingInvoiceFrmConfig"
                      :state="validateState('frmInvoice.invoice_init_sequential')"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-form-row>

              <b-form-row>
                <b-col cols="12">
                  <b-form-group
                    label="Días de corte para las facturas"
                    description="Día del mes en que seran generadas las facturas para los clientes y cuantos días se puede esperar para que un cliente pague."
                    label-class="font-weight-bold"
                    label-size="sm"
                  >
                    <b-form-row>
                      <!-- Beging Month -->
                      <b-col md="3" sm="6">
                        <b-form-group
                          label="Inicio de mes"
                          label-size="sm"
                          id="lbl-invoice-generation-begin-month"
                          label-for="select-invoice-generation-begin-month"
                        >
                          <b-form-select
                            id="select-invoice-generation-begin-month"
                            :options="getDays"
                            v-model="$v.frmInvoice.invoice_generation_begin_month.value.$model"
                            required
                            size="sm"
                            @change="saveItemConfig(frmInvoice.invoice_generation_begin_month,'savingInvoiceGenerationBeginMonth')"
                            :disabled="statesItemFrm.savingInvoiceGenerationBeginMonth || statesItemFrm.savingInvoiceFrmConfig"
                            :state="validateState('frmInvoice.invoice_generation_begin_month')"
                          ></b-form-select>
                        </b-form-group>
                      </b-col>

                      <!-- Each 15 days -->
                      <b-col md="3" sm="6">
                        <b-form-group
                          label="Mediado de mes"
                          label-size="sm"
                          id="lbl-invoice-each-fifteen-days"
                          label-for="select-invoice-each-fifteen-days"
                        >
                          <b-form-select
                            id="select-invoice-each-fifteen-days"
                            :options="getDays"
                            v-model="$v.frmInvoice.invoice_each_fifteen_days.value.$model"
                            required
                            size="sm"
                            @change="saveItemConfig(frmInvoice.invoice_each_fifteen_days,'savingInvoiceEachFifteenDays')"
                            :disabled="statesItemFrm.savingInvoiceEachFifteenDays || statesItemFrm.savingInvoiceFrmConfig"
                            :state="validateState('frmInvoice.invoice_each_fifteen_days')"
                          ></b-form-select>
                        </b-form-group>
                      </b-col>

                      <!-- End Month -->
                      <b-col md="3" sm="6">
                        <b-form-group
                          label="Fines de mes"
                          label-size="sm"
                          id="lbl-invoice-generation-end-month"
                          label-for="select-invoice-generation-end-month"
                        >
                          <b-form-select
                            id="select-invoice-generation-end-month"
                            :options="getDays"
                            v-model="$v.frmInvoice.invoice_generation_end_month.value.$model"
                            required
                            size="sm"
                            @change="saveItemConfig(frmInvoice.invoice_generation_end_month,'savingInvoiceGenerationEndMonth')"
                            :disabled="statesItemFrm.savingInvoiceGenerationEndMonth || statesItemFrm.savingInvoiceFrmConfig"
                            :state="validateState('frmInvoice.invoice_generation_end_month')"
                          ></b-form-select>
                        </b-form-group>
                      </b-col>

                      <!-- wait for -->
                      <b-col md="3" sm="6">
                        <b-form-group
                          label="Días de espera en pagos"
                          label-size="sm"
                          id="lbl-wait-for-pay-invoices"
                          label-for="select-wait-for-pay-invoices"
                        >
                          <b-form-select
                            id="select-wait-for-pay-invoices"
                            :options="getDays"
                            v-model="$v.frmInvoice.wait_for_pay_invoices.value.$model"
                            required
                            size="sm"
                            @change="saveItemConfig(frmInvoice.wait_for_pay_invoices,'waitForPayInvoices')"
                            :disabled="statesItemFrm.waitForPayInvoices || statesItemFrm.savingInvoiceFrmConfig"
                            :state="validateState('frmInvoice.wait_for_pay_invoices')"
                          ></b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-form-row>
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
                    :disabled="$v.frmInvoice.$invalid"
                  >
                    <feather
                      v-show="statesItemFrm.savingInvoiceFrmConfig"
                      type="settings"
                      animation="spin"
                      animation-speed="slow"
                      class="align-top"
                      size="15"
                    ></feather>
                    <feather v-show="!statesItemFrm.savingInvoiceFrmConfig" type="save" class="align-top" size="15"></feather>
                    <span v-show="!statesItemFrm.savingInvoiceFrmConfig">Guardar</span>
                    <span v-show="statesItemFrm.savingInvoiceFrmConfig">Guardando</span>
                  </b-button>
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
        savingInvoiceGenerationBeginMonth: false,
        savingInvoiceEachFifteenDays: false,
        savingInvoiceGenerationEndMonth: false,
        waitForPayInvoices: false,
        savingInvoiceInitSequential: false,
        savingInvoiceFrmConfig: false
      },
      frmInvoice: {
        legal_representant: {},
        tax_identification: {},
        invoice_init_sequential: {},
        invoice_generation_begin_month: {},
        invoice_each_fifteen_days: {},
        invoice_generation_end_month: {},
        wait_for_pay_invoices: {}
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
      },
      invoice_generation_begin_month: {
        value: {
          required
        }
      },
      invoice_each_fifteen_days: {
        value: {
          required
        }
      },
      invoice_generation_end_month: {
        value: {
          required
        }
      },
      wait_for_pay_invoices: {
        value: {
          required
        }
      }
    }
  },
  computed: {
    getDays: () => {
      let days = [];
      for (let index = 1; index < 32; index++) {
        days.push(index);
      }
      return days;
    }
  },
  methods: {
    saveItemConfig(data, item) {
      if (!data.value) return false;
      this.statesItemFrm[item] = true;
      AccountingService.saveItemConfig(data)
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
    },
    saveFrmInvoice() {
      if (this.$v.frmInvoice.$invalid) return false;
      this.statesItemFrm.savingInvoiceFrmConfig = true;
      AccountingService.saveAllForm(this.frmInvoice).then(result => {
        this.statesItemFrm.savingInvoiceFrmConfig = false;
        this.frmService = result;
        this.makeToast({
          content: "Configuración de Facturación Guardada",
          title: "Atención",
          variant: "info"
        });
      });
    }
  },
  mounted() {
    this.loadInvoiceConfig("invoice", this.frmInvoice);
  }
};
</script>

<style>
</style>