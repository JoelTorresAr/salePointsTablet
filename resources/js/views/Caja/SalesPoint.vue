<template>
  <v-app>
    <v-main app>
      <v-card flat tile>
        <v-toolbar flat dense>
          <v-toolbar-title>
            <v-btn>
              <v-icon>mdi-note-text-outline</v-icon>
            </v-btn>
          </v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <div class="display-1">{{datenow}}</div>
          <v-spacer></v-spacer>
          <div class="blue-grey darken-2 ml-2 mr-1 pr-1 pl-1">
            <div>
              <small>
                <b>cantidad</b>
              </small>
            </div>
            <small>
              <b>cantidad</b>
            </small>
          </div>
          <div class="blue-grey darken-2 ml-1 mr-2 pr-1 pl-1">
            <div>
              <small>
                <b>cantidad</b>
              </small>
            </div>
            <small>
              <b>cantidad</b>
            </small>
          </div>
          <v-btn color="warning">
            <v-icon>mdi-arrow-left-bold</v-icon>
          </v-btn>
        </v-toolbar>
      </v-card>
      <v-row>
        <v-col cols="8">
          <v-toolbar flat dense>
            <v-toolbar-title>
              <v-btn @click="windowID=1">
                <img src="/img/ico-mesa2.svg" alt="icono de mesa" style="height: 3rem" /> MESAS
              </v-btn>
            </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-btn @click="windowID=2">
              <img src="/img/ico-tupper.svg" alt="icono de mesa" style="height: 3rem" /> PARA LLEVAR
            </v-btn>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-btn @click="windowID=3">
              <img src="/img/ico-delivery.svg" alt="icono de mesa" style="height: 3rem" /> DELIVERY
            </v-btn>
            <v-spacer></v-spacer>
            <v-select
              :items="items"
              item-text="name"
              item-value="name"
              style="max-width: 12rem!important;"
              dense
              v-model="itemSelected"
            ></v-select>
          </v-toolbar>
          <v-window v-model="windowID">
            <v-window-item :value="1">
              <desk-component />
            </v-window-item>
            <v-window-item :value="2">
              <articles-component />
            </v-window-item>
            <v-window-item :value="3">
              <v-card color="success" dark height="6rem" width="8rem" class="pa-2 mt-4 ml-4 mr-3">
                <v-card-title class="p-0">NUEVO</v-card-title>
              </v-card>
            </v-window-item>
          </v-window>
        </v-col>
        <v-col cols="4">
          <v-row style="height: 75vh !important;">
            <v-col cols="12" class="grey darken-4 spacio-entre-items">
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-fee.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>DESCOBRAR</b>
                    </small>
                  </div>
                </div>
              </v-btn>
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-unlock.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>LIBERAR</b>
                    </small>
                  </div>
                </div>
              </v-btn>
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-check.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>PRECUENTA</b>
                    </small>
                  </div>
                </div>
              </v-btn>
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-print-kitchen.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>COCINA</b>
                    </small>
                  </div>
                </div>
              </v-btn>
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-aditional.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>ADICIONAL</b>
                    </small>
                  </div>
                </div>
              </v-btn>
              <v-btn @click="windowID=1" class="pl-0 pr-0" style="height: 4rem !important;">
                <div>
                  <div>
                    <img src="/img/icons/ico-trash.svg" alt="icono" style="height: 2.5rem" />
                  </div>
                  <div>
                    <small>
                      <b>ELIMINAR</b>
                    </small>
                  </div>
                </div>
              </v-btn>
            </v-col>
          </v-row>
          <v-row class="grey darken-4">
            <v-col cols="12">SUBTOTALES</v-col>
            <v-col cols="12">ADICIONALES</v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    datenow: "",
    windowID: 1,
    items: [
      {
        name: "VENTA REGULAR"
      },
      {
        name: "CREDITO PERSONAL"
      },
      {
        name: "CORTESIAS"
      },
      {
        name: "CONSUMO DE PERSONAL"
      },
      {
        name: "SE FUE SIN PAGAR"
      }
    ],
    itemSelected: "VENTA REGULAR"
  }),
  computed: {},
  created() {
    this.$vuetify.theme.dark = true;
    setInterval(() => {
      this.datenow = moment().format("dddd D MMM h:mm:ss a");
    }, 1000);
  },
  methods: {
    time() {}
  }
};
</script>

<style>
.spacio-entre-items {
  display: flex;
  justify-content: space-between;
}
</style>