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

      <template #cell(editar)="row">
        <b-button
          size="sm"
          variant="warning"
          @click="editOportunidade(row.item)"
        >
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

    <b-modal
      id="modal-scrollable"
      v-model="showModalSave"
      scrollable
      title="Nova Oportunidade"
      size="xl"
      hide-footer
    >
      <template #modal-title> Nuevo cupón </template>
      <div class="d-block text-center"></div>
      <hr />
      <b-col>
        <form>
          <b-form>
            <b-row>
              <!-- INPUT JORNADA -->
              <b-col>
                <b-form-group
                  id="input-group-local"
                  label="Jornada"
                  label-for="input-local"
                >
                  <b-form-input
                    id="input-jornada"
                    type="text"
                    placeholder="Jornada"
                    v-model="form.cupon"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>

              <!-- INPUT BOLSA -->
              <b-col>
                <b-form-group
                  id="input-group-salario"
                  label="Bolsa Salário"
                  label-for="input-bolsa"
                >
                  <b-form-input
                    id="input-bolsa"
                    type="number"
                    placeholder="Bolsa Salário"
                    required
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>

            <!-- INPUT DESCRICAO -->
            <b-form-group
              id="input-group-descricao"
              label="Descrição"
              label-for="input-descricao"
              description="Descrição da oportunidade"
            >
              <b-form-textarea
                id="input-descricao"
                type="text"
                placeholder="Descrição"
                required
              ></b-form-textarea>
            </b-form-group>

            <!-- INPUT CONTATO -->
            <b-form-group
              id="input-group-contato"
              label="Contato"
              label-for="input-contato"
              description="Contato"
            >
              <b-form-textarea
                id="input-contato"
                type="text"
                placeholder="Contato"
                required
              ></b-form-textarea>
            </b-form-group>

            <!-- INPUT HABILIDADES -->
            <b-form-group
              id="input-group-habilidades"
              label="Habilidades"
              label-for="input-habilidades"
              description="Descrever quais habilidades são fundamentais"
            >
              <b-form-textarea
                id="input-bolsa"
                type="text"
                placeholder="Habilidades"
                required
              ></b-form-textarea>
            </b-form-group>

            <!-- ROW DATAS -->
            <b-row>
              <b-col>
                <label for="date-expiration">Fecha de Expiración</label>
                <b-form-datepicker
                  id="date-expiration"
                  class="mb-2"
                ></b-form-datepicker>
              </b-col>
            </b-row>
          </b-form>

          <load-component :isVisible="load" :text="textLoad" />
          <button
            type="submit"
            size="sm"
            class="btn btn-primary"
          >
            Salvar
          </button>
        </form>
      </b-col>
    </b-modal>
  </div>
</template>





<script>
export default {
  data() {
    return {
      showModalSave: false,
      load: false,
      textLoad: "",
      items: [],
      form: {
        cupon: "",
      },
      fields: [
        {
          key: "cod",
          label: "Cod",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "cupon",
          label: "Cupón",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "dateExpiration",
          label: "Fecha de expiración",
          sortable: true,
          sortDirection: "desc",
        },
        { key: "editar", label: "Editar" },
        { key: "delete", label: "Eliminar" },
      ],
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
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    showModalRegister() {
      this.showModalSave = true;
    },
  },
};
</script>
