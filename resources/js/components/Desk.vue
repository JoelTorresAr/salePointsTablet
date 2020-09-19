<template>
  <perfect-scrollbar>
    <v-col cols="12" v-show="loading">
      <app-spinner></app-spinner>
    </v-col>
    <v-card class="d-flex flex-wrap oscuro" flat tile>
      <v-card
        v-for="(item, index) in mesas"
        :key="index"
        :color="item.st_mesa=='L'?'success':'error'"
        dark
        height="6rem"
        width="8rem"
        class="pa-2 mt-4 ml-4 mr-3"
        @click="actionMesa(item,index)"
      >
        <v-card-title class="p-0">
          {{item.nombre}}
          <i v-show="showChecksinMesa(item)" :class="checkJoin(index)"></i>
        </v-card-title>
        <v-card-text class="pb-0">
          {{item.mesero}}
          <i :class="getIcon(item)"></i>
        </v-card-text>
        <v-card-text class="p-0">
          <div class="mesa__header">
            <i v-show="item.juntada == 1" class="fas fa-link black--text"></i>
          </div>
        </v-card-text>
      </v-card>
    </v-card>
  </perfect-scrollbar>
</template>

<script>
export default {
  data: () => ({
    loading: false,
    mesas: []
  }),
  created() {
    this.getMesas();
  },
  methods: {
    getIcon(item) {
      var st_cmd = item.st_cmd;
      var icon = "";
      switch (st_cmd) {
        case "1":
          //Pidio precuenta

          break;
        case "3":
          //Pidio precuenta
          icon = "fas fa-coins";
          break;

        case "4":
          //Esta en preparción
          icon = "mdi mdi-pot-steam";
          break;

        default:
          break;
      }
      return icon;
    },
    actionButtons(key) {
      switch (key) {
        case "JUNTAR":
          if (this.showJoins) {
            this.actionButton = "";
            this.showJoins = !this.showJoins;
            this.unirMesas();
          } else {
            this.actionButton = "JUNTAR";
            this.arrayMesas = [];
            this.showJoins = !this.showJoins;
          }
          break;
        case "SEPARAR":
          if (this.showJoins) {
            this.showJoins = !this.showJoins;
            this.separarMesas();
          } else {
            this.actionButton = "SEPARAR";
            this.arrayMesas = [];
            this.showJoins = !this.showJoins;
          }
          break;
        case "MOVER":
          if (this.showJoins) {
            this.showJoins = !this.showJoins;
            this.moverMesas();
          } else {
            console.log("mover");
            this.actionButton = "MOVER";
            this.arrayMesas = [];
            this.showJoins = !this.showJoins;
          }
          break;

        default:
          break;
      }
    },
    actionMesa(item, index) {
      var st_cmd = item.st_cmd;
      switch (this.actionButton) {
        case "JUNTAR":
          if ((st_cmd != "3") & (st_cmd != "4")) {
            var existe = false;
            var ix;
            this.arrayMesas.forEach(e => {
              if (e.id == index) {
                existe = true;
                ix = e;
              }
            });
            if (existe) {
              var i = this.arrayMesas.indexOf(ix);
              this.arrayMesas.splice(i, 1);
            } else {
              var mesa = {
                id: index,
                id_cmd: item.id_cmd,
                st_cmd: item.st_cmd,
                st_join: 1
              };
              this.arrayMesas.push(mesa);
            }
          }
          break;
        case "SEPARAR":
          if (item.juntada === 1) {
            var existe = false;
            var ix;
            this.arrayMesas.forEach(e => {
              if (e.id == index) {
                existe = true;
                ix = e;
              }
            });
            if (existe) {
              this.arrayMesas = [];
            } else {
              var mesa = {
                id: index,
                id_cmd: item.id_cmd,
                st_cmd: item.st_cmd,
                st_join: 1
              };
              this.arrayMesas = [];
              this.arrayMesas.push(mesa);
            }
          }
          break;
        case "MOVER":
          if ((st_cmd != "3") & (st_cmd != "4")) {
            var existe = false;
            var ix;
            this.arrayMesas.forEach(e => {
              if (e.id == index) {
                existe = true;
                ix = e;
              }
            });
            if (existe) {
              var i = this.arrayMesas.indexOf(ix);
              this.arrayMesas.splice(i, 1);
            } else {
              if (this.arrayMesas.length < 2) {
                var mesa = {
                  id: index,
                  id_cmd: item.id_cmd,
                  st_cmd: item.st_cmd,
                  st_join: 1
                };
                this.arrayMesas.push(mesa);
              }
            }
          }
          break;

        default:
          this.newComanda(item, index);
          break;
      }
    },
    checkJoin(index) {
      var std = "";
      switch (this.actionButton) {
        case "JUNTAR":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == index) {
              std = "mdi mdi-checkbox-marked-outline";
            }
          });
          break;
        case "SEPARAR":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == index) {
              std = "mdi mdi-checkbox-marked-outline";
            }
          });
          break;
        case "MOVER":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == index) {
              std = "mdi mdi-checkbox-marked-outline";
            }
          });
          break;

        default:
          break;
      }
      return std;
    },
    showChecksinMesa(item) {
      var st_cmd = item.st_cmd;
      var std = false;
      switch (this.actionButton) {
        case "JUNTAR":
          if (this.showJoins & (st_cmd != "3") & (st_cmd != "4")) {
            std = true;
          }
          break;
        case "SEPARAR":
          if (this.showJoins & (item.juntada === 1)) {
            std = true;
          }
          break;
        case "MOVER":
          if (this.showJoins & (st_cmd != "3") & (st_cmd != "4")) {
            std = true;
          }
          break;

        default:
          break;
      }
      return std;
    },
    getMesas() {
      this.loading = true;
      this.mesas = [
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        },
        {
          st_mesa: "L",
          nombre: "MESA 01",
          mesero: "",
          juntada: 0
        }
      ];
      this.loading = false;
    }
  }
};
</script>

<style>
.ps {
  height: 75vh !important;
}
.oscuro{
  background-color: #121212!important;
}
</style>