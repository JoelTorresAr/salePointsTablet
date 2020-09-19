<template>
  <v-app>
    <v-main app>
      <v-row>
        <v-col cols="3" class="grey darken-4" style="height:100vh">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="text-center">NOMBRE DE CAJA</v-list-item-title>
              <v-list-item-subtitle>
                <v-row>
                  <v-col cols="6">
                    <v-menu
                      ref="menu"
                      v-model="modalfirstdate"
                      :close-on-content-click="false"
                      :return-value.sync="firstdate"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <button class="btn btn-secondary btn-block" v-bind="attrs" v-on="on">
                          <i class="fas fa-calendar-alt mr-1"></i>
                          {{firstdate}}
                        </button>
                      </template>
                      <v-date-picker
                        v-model="firstdate"
                        :max="new Date().toISOString().substr(0, 10)"
                        no-title
                        scrollable
                      >
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="modalfirstdate = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.menu.save(firstdate)">OK</v-btn>
                      </v-date-picker>
                    </v-menu>
                  </v-col>
                  <v-col cols="6">
                    <v-menu
                      ref="menu2"
                      v-model="modalseconddate"
                      :close-on-content-click="false"
                      :return-value.sync="seconddate"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <button class="btn btn-secondary btn-block" v-bind="attrs" v-on="on">
                          <i class="fas fa-calendar-alt mr-1"></i>
                          {{seconddate}}
                        </button>
                      </template>
                      <v-date-picker
                        v-model="seconddate"
                        :max="new Date().toISOString().substr(0, 10)"
                        no-title
                        scrollable
                      >
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="modalseconddate = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.menu2.save(seconddate)">OK</v-btn>
                      </v-date-picker>
                    </v-menu>
                  </v-col>
                </v-row>
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item v-for="(item, index) in openingTable" :key="index" class="pl-2 pr-2">
            <v-list-item-title>
              <v-row>
                <v-col cols="6">{{ item.date }}</v-col>
                <v-col cols="6" class="text-end">{{ item.mount }}</v-col>
              </v-row>
            </v-list-item-title>
            <v-list-item-content>
              <v-list-item-subtitle>
                <v-row>
                  <v-col cols="12"></v-col>
                </v-row>
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-col>
        <v-col cols="9">
          <v-row>
            <v-col cols="12">
              <v-card color="rgb(0, 0, 0, 0.1)" dark>
                <v-row>
                  <v-col cols="9">
                    <div class="ml-2">
                      <h1>VENTA TODAL</h1>
                      <h2>{{seconddate}}</h2>
                      <h3>S/.1054</h3>
                    </div>
                  </v-col>
                  <v-col cols="3">
                    <v-card color="rgb(0, 0, 0, 0.1)" dark>
                      <v-card-text>
                        <div class="text-end">
                          <span>SALDOS</span>
                        </div>
                        <div class="card__text">
                          <span>EFECTIVO</span>
                          <span>S/.1054</span>
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
          </v-row>
          <table style="width:100%" class="ml-3">
            <tr v-for="(item, index) in mainTable" :key="index">
              <td>
                <i :class="getIcon(item.action)"></i>
              </td>
              <td>{{item.date}}</td>
              <td>{{item.name}}</td>
              <td>S/. {{item.mount}}</td>
              <td>{{item.coin}}</td>
              <td>
                <v-chip class="ma-2" x-small color="green">{{item.action}}</v-chip>
              </td>
            </tr>
          </table>
        </v-col>
      </v-row>
    </v-main>
    <v-footer app class="text--accent-3" style="height: 5rem;">
      <v-row>
        <v-col cols="4">
          <v-btn
            class="ma-2 white--text mt-0 btn btn-secondary dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="far fa-user-circle"></i> PRUEBA
          </v-btn>
          <div class="dropdown-menu grey darken-3" style="width:15rem">
            <v-btn text small class="dropdown-item  green--text">COMPRAS</v-btn>
            <v-btn text small class="dropdown-item  green--text">PRESTAMOS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item  green--text">GASTOS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item  green--text">RECETAS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item  green--text">INVENTARIOS</v-btn>
            <v-btn text small class="dropdown-item  green--text">MOVIMIENTOS DE ALMACEN</v-btn>
            <v-btn text small class="dropdown-item  green--text">KARDEX</v-btn>
            <v-btn text small class="dropdown-item  green--text">VENTA PRODUCTOS</v-btn>
            <v-btn text small class="dropdown-item  green--text">VENTA INSUMOS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item  green--text">CAJON</v-btn>
            <v-btn text small class="dropdown-item  green--text"><i class="mdi mdi-printer"></i>IMPRESORAS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item  green--text">SALIR</v-btn>
          </div>
        </v-col>
        <v-spacer></v-spacer>
        <v-col cols="8" class="text-end">
          <v-btn
            class="ma-2 white--text mt-0 btn btn-secondary dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <v-icon>mdi mdi-printer</v-icon> REPORTES
          </v-btn>
          <div class="dropdown-menu grey darken-3" style="width:15rem">
            <v-btn text small class="dropdown-item green--text">CIERRE</v-btn>
            <v-btn text small class="dropdown-item green--text">ARQUEO DE CAJA</v-btn>
            <v-btn text small class="dropdown-item green--text">MOVIMIENTOS DE CAJA</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item green--text">VENTAS POR PRODUCTOS</v-btn>
            <v-btn text small class="dropdown-item green--text">VENTAS POR INSUMOS</v-btn>
            <v-btn text small class="dropdown-item green--text">VENTAS ELIMINADAS</v-btn>
            <v-btn text small class="dropdown-item green--text">OTRAS SALIDAS DE INSUMOS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item green--text">BITACORA DE PRESTAMOS</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item green--text">VENTA DE PRODUCTOS(ES PRUEBA)</v-btn>
            <v-divider class="mt-0 mb-0"></v-divider>
            <v-btn text small class="dropdown-item green--text">CARTA DE PRODUCTOS</v-btn>
            <v-btn text small class="dropdown-item green--text">RECETAS DE PRODUCTOS</v-btn>
            <v-btn text small class="dropdown-item green--text">BAR STOCK DE INSUMOR DIARIOS</v-btn>
            <v-btn text small class="dropdown-item green--text">BAR STOCK DE INSUMOR SEMANAL</v-btn>
          </div>
          <v-btn class="ma-2 white--text mt-0" tile min-width="8rem" color="grey darken-2">
            <v-icon color="blue">mdi-sack</v-icon> MOVIMIENTO
          </v-btn>
          <v-btn class="ma-2 white--text mt-0" tile min-width="8rem" color="grey darken-2">
            <v-icon color="yellow accent-4">mdi-safe-square-outline</v-icon> CERRAR CAJA
          </v-btn>
          <v-btn
            class="ma-2 white--text mt-0"
            tile
            min-width="8rem"
            color="grey darken-2"
            @click="logout"
          >
            <i class="fas fa-store"></i> PUNTO DE VENTA
          </v-btn>
        </v-col>
      </v-row>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    firstdate: "",
    seconddate: "",
    modalfirstdate: false,
    modalseconddate: false,
    loading: true,
    actionButton: "",
    switchNavegator: true,
    dropdown_actions: [
      { accion: "COMPRAS", icon: "fas fa-circle-notch" },
      { accion: "PRESTAMOS", icon: "fas fa-circle-notch" },
      { accion: "GASTOS", icon: "fas fa-circle-notch" },
      { accion: "RECETAS", icon: "fas fa-circle-notch" },
      { accion: "INVENTARIOS", icon: "fas fa-circle-notch" },
      { accion: "MOVIMIENTOS DE ALMACEN", icon: "fas fa-circle-notch" },
      { accion: "CARDEX", icon: "fas fa-circle-notch" },
      { accion: "VENTAS PRODUCTOS", icon: "fas fa-circle-notch" },
      { accion: "VENTAS INSUMOS", icon: "fas fa-circle-notch" },
      { accion: "CAJON", icon: "fas fa-circle-notch" },
      { accion: "IMPRESORA", icon: "fas fa-circle-notch" },
      { accion: "SALIR", icon: "fas fa-circle-notch" }
    ],
    buttonKeys: [
      { accion: "JUNTAR", icon: "fas fa-circle-notch" },
      { accion: "COBRAR", icon: "fas fa-circle-notch" },
      { accion: "ELIMINAR", icon: "fas fa-circle-notch" },
      { accion: "SEPARAR", icon: "fas fa-circle-notch" },
      { accion: "MOVER", icon: "fas fa-circle-notch" }
    ],
    mainTable: [
      {
        action: "ENTRADA",
        date: "2020-08-25",
        mount: 1500,
        coin: "SOLES",
        name: "APERTURA DE CAJA"
      },
      {
        action: "SALIDA",
        date: "2020-08-25",
        mount: 50,
        coin: "SOLES",
        name: "COMPRA DE PRODUCTO"
      },
      {
        action: "SALIDA",
        date: "2020-08-25",
        mount: 30,
        coin: "SOLES",
        name: "COMPRA DE PRODUCTO"
      }
    ],
    openingTable: [
      { date: "2020-08-25", mount: 1540 },
      { date: "2020-08-24", mount: 1540 }
    ],
    ip: "",
    user: "",
    dialog: false
  }),
  watch: {
    pisos(val) {}
  },
  created() {
    var currentDate = new Date();
    var days = 86400000; //number of milliseconds in a day
    this.firstdate = new Date(currentDate - 7 * days)
      .toISOString()
      .substr(0, 10);
    this.seconddate = currentDate.toISOString().substr(0, 10);
    console.log(this.firstdate);
    this.$vuetify.theme.dark = true;
    this.user = this.$store.getters.getUSERNAME;
  },
  methods: {
    getIcon(action) {
      switch (action) {
        case "ENTRADA":
          return "fas fa-arrow-circle-right green--text";
          break;
        case "SALIDA":
          return "fas fa-arrow-circle-left red--text";
          break;

        default:
          return "";
          break;
      }
    },
    logout() {
      this.$store.commit("SET_PIN", null);
      this.$router.push({ name: "Login" });
    }
  }
};
</script>
<style>
.centered-input input {
  text-align: center;
}
#inspireme--body--index {
  height: 70vh;
}
.__vuescroll .hasVBar {
  height: 60vh !important;
}
.card__text {
  display: flex;
  justify-content: space-between;
}
</style>