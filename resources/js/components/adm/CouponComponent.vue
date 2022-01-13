<template>
  <div>
    <br />
    <br />
    <b-jumbotron lead="ADM Cupones"
      ><b-button size="sm" variant="primary" @click="showModalRegister()">
        <b-icon icon="plus-square" aria-hidden="true"></b-icon> Agregar nuevo
      </b-button>
    </b-jumbotron>

    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filtrar"
          label-for="filter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Escribe para buscar"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''"
                >Limpiar</b-button
              >
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
        <b-form-group
          label="Elem. por página"
          label-for="per-page-select"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="perPage"
            :options="pageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col sm="7" md="6" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
    </b-row>
    <!-- Main table element -->
    <b-table
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filter-included-fields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      stacked="md"
      show-empty
      small
      @filtered="onFiltered"
    >
      <template #cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template #cell(edit)="row">
        <b-button size="sm" variant="warning" @click="editCoupon(row.item)">
          <b-icon icon="pencil-square" aria-hidden="true"></b-icon>
        </b-button>
      </template>

      <template #cell(delete)="row">
        <b-button
          size="sm"
          variant="danger"
          @click="modalShow(row.item, 'REMOVE')"
        >
          <b-icon icon="trash-fill" aria-hidden="true"></b-icon>
        </b-button>
      </template>
    </b-table>

    <!-- Modal register new coupon -->
    <b-modal
      id="modal-scrollable"
      v-model="showModalSave"
      variant="primary"
      :header-bg-variant="headerBgVariant"
      :header-text-variant="headerTextVariant"
      title="Registrar cupón"
      size="xl"
      hide-footer
    >
      <template #modal-title> Nuevo cupón </template>
      <div class="d-block text-center"></div>
      <hr />
      <b-col>
        <form @submit.prevent="validateForm('SAVE')">
          <b-form>
            <b-row>
              <!-- INPUT NAME -->
              <b-col>
                <b-form-group
                  id="input-group-coupon"
                  label="Nombre"
                  label-for="input-coupon"
                >
                  <b-form-input
                    id="input-coupon"
                    type="text"
                    placeholder="Nombre"
                    v-model="form.COUPON"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>
            <b-row>
              <!--COL INPUT TYPE -->
              <b-col>
                <b-form-group label="Tipo:" label-for="input-type">
                  <b-form-select
                    required
                    v-model="form.TYPE"
                    :options="typeCoupon"
                  ></b-form-select>
                </b-form-group>
              </b-col>

              <!--COL INPUT TYPE -->
              <b-col>
                <b-form-group
                  id="input-group-value"
                  label="Valor:"
                  label-for="input-value"
                >
                  <b-form-input
                    id="input-value"
                    type="number"
                    placeholder="Valor"
                    v-model="form.VALUE"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>

            <!-- ROW USE LIMIT -->
            <b-row>
              <b-col md="2">
                <b-form-checkbox
                  id="checkbox-limit-use"
                  v-model="form.LIMIT"
                  name="checkbox-limit-use"
                  value="true"
                  unchecked-value="false"
                  >¿El Cupón tendrá un límite de uso?
                </b-form-checkbox>
              </b-col>
              <b-col md="2" style="heigth: 80px">
                <b-form-group
                  id="input-group-value-limit"
                >
                  <b-form-input
                    :readonly="form.LIMIT == 'false' || form.LIMIT == ''"
                    id="input-value-limit"
                    type="number"
                    placeholder="Límite "
                    v-model="form.LIMIT_VALUE"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>
            <br />
            <br />
            <!-- ROW DATES -->
            <b-row>
              <!-- EXPIRATION DATE -->
              <b-col>
                <label for="date-expiration">Fecha de vencimiento: </label>
                <b-form-datepicker
                  id="date-expiration"
                  v-model="form.DATE_EXPIRATION"
                  class="mb-2"
                ></b-form-datepicker>
              </b-col>
            </b-row>

            <!-- INPUT DESCRIPTION -->
            <b-form-group
              id="input-group-description"
              label="Descripción:"
              label-for="input-description"
              description="Describa la descripción del cupón"
            >
              <b-form-textarea
                id="input-description"
                type="text"
                v-model="form.DESCRIPTION"
                placeholder="Descripción"
                required
              ></b-form-textarea>
            </b-form-group>
          </b-form>

          <load-component :isVisible="load" :text="textLoad" />
          <button type="submit" size="sm" class="btn btn-primary">
            Salvar
          </button>
        </form>
      </b-col>
    </b-modal>

    <!-- Modal edit a coupon -->
    <b-modal
      id="modal-scrollable"
      v-model="showModalEdit"
      variant="primary"
      :header-bg-variant="headerBgVariant"
      :header-text-variant="headerTextVariant"
      title="Editar cupón"
      size="xl"
      hide-footer
    >
      <template #modal-title> Editar cupón </template>
      <div class="d-block text-center"></div>
      <hr />
      <b-col>
        <form @submit.prevent="validateForm('EDIT')">
          <b-form>
            <b-row>
              <!-- INPUT COD -->
              <b-col>
                <b-form-group
                  id="input-group-cod"
                  label="Cod."
                  label-for="input-cod"
                >
                  <b-form-input
                    id="input-cod"
                    type="text"
                    placeholder="Cod."
                    v-model="itemsEdit.COD"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>

              <!-- INPUT COUPON -->
              <b-col>
                <b-form-group
                  id="input-group-coupon"
                  label="Nombre"
                  label-for="input-coupon"
                >
                  <b-form-input
                    id="input-coupon"
                    type="text"
                    placeholder="Nombre"
                    v-model="itemsEdit.COUPON"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>

            <!-- ROW DATES -->
            <b-row>
              <!-- DATE EXPIRATION -->
              <b-col>
                <label for="date-expiration">Fecha de vencimiento</label>
                <b-form-datepicker
                  id="date-expiration"
                  v-model="itemsEdit.DATE_EXPIRATION"
                  class="mb-2"
                ></b-form-datepicker>
              </b-col>
            </b-row>

            <!-- INPUT DESCRIPTION -->
            <b-form-group
              id="input-group-description"
              label="Descripción"
              label-for="input-description"
              description="Describa la descripción del cupón"
            >
              <b-form-textarea
                id="input-description"
                type="text"
                placeholder="Descripción"
                v-model="itemsEdit.DESCRIPTION"
                required
              ></b-form-textarea>
            </b-form-group>
          </b-form>

          <load-component :isVisible="load" :text="textLoad" />
          <button type="submit" size="sm" class="btn btn-primary">
            Salvar
          </button>
        </form>
      </b-col>
    </b-modal>

    <!-- Modal remove coupon -->
    <b-modal
      id="bv-modal-remove-oportunidade"
      v-model="showModalRemove"
      hide-footer
    >
      <template #modal-title> Eliminar cupón </template>
      <div class="d-block text-center">
        <p style="font-size: 12px">
          ¿Realmente quieres eliminar este cupón {{ itemsEdit.COUPON }}?
        </p>
      </div>
      <b-button class="sm" variant="danger" block @click="remove(itemsEdit.COD)"
        >Remover</b-button
      >
    </b-modal>
    <!-- Modal remove coupon -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      typeCoupon: [
        { text: "Monto", value: "monto" },
        { text: "Porcentaje", value: "porcent" },
      ],

      // Controls styles modal
      headerBgVariant: "primary",
      headerTextVariant: "light",

      // Modal properties
      showModalRemove: false,
      showModalEdit: false,
      showModalSave: false,

      // Controls properties utils components
      load: false,
      textLoad: "",

      // Items data table
      itemCoupon: [],
      items: [
        {
          COD: 23456,
          COUPON: "10* off day",
          DESCRIPTION: "Cupón campaña de verano.",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23456,
          COUPON: "30* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23457,
          COUPON: "40* off day",
          DESCRIPTION: "Cupón campaña de verano.",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
        {
          COD: 23478,
          COUPON: "50* off day",
          DESCRIPTION: "cupón de descuento de fin de semana",
          DATE_EXPIRATION: new Date("2022-01-31"),
        },
      ],
      itemsEdit: { COD: "", COUPON: "", DATE_EXPIRATION: "", DESCRIPTION: "" },
      form: {
        COUPON: "",
        TYPE: "",
        VALUE: "",
        DATE_EXPIRATION: "",
        DESCRIPTION: "",
        LIMIT: "",
        LIMIT_VALUE: "",
      },

      // Fields data table
      fields: [
        {
          key: "COD",
          label: "Cod",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "COUPON",
          label: "Descrición",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "DESCRIPTION",
          label: "Descrición",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "DATE_EXPIRATION",
          label: "Fecha de vencimiento",
          sortable: true,
          sortDirection: "desc",
        },

        { key: "edit", label: "Editar" },
        { key: "delete", label: "Eliminar" },
      ],

      // Properties data table
     totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [5, 10, 15, 20, 30],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
    };
  },
  async mounted() {
    await this.getCoupons();

    // Set the initial number of items data table
    this.totalRows = this.items.length;
  },
  methods: {
    async getCoupons() {
      this.load = true;
      this.textLoad = "Cargando informacion...";
      console.log(this.load);
      setTimeout((this.load = false), 3000);
    },

    async editCoupon(item) {
      //this.load = true;
      console.log("ITEM TO EDIT:" + item.NAME);

      this.modalShow(item, "EDIT");
    },

    async save() {
      this.showModalSave = !this.showModalSave;
      Toast.fire({
        icon: "success",
        title: "¡Cupón registrado con éxito!",
      });
    },

    async update() {},

    async remove() {},

    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    showModalRegister() {
      this.showModalSave = true;
    },
    validateForm(typeRequest) {
      if (typeRequest == "SAVE") {
        if (this.form.COUPON == "") {
          Toast.fire({
            icon: "warning",
            title: "informar el nombre!",
          });
          return;
        }
        if (this.form.DESCRIPTION == "") {
          Toast.fire({
            icon: "warning",
            title: "informar la descripción!",
          });
          return;
        }

        if (this.form.DATE_EXPIRATION == "") {
          Toast.fire({
            icon: "warning",
            title: "Informar la fecha de vencimiento!",
          });
          return;
        }

        this.save();
      } else {
        this.update();
      }
    },
    modalShow(item, type) {
      this.itemsEdit = item;
      console.log("ITEMS EDIT" + item.COD);
      if (type == "REMOVE") this.showModalRemove = !this.showModalRemove;
      if (type == "EDIT") this.showModalEdit = !this.showModalEdit;
    },
  },
};
</script>
