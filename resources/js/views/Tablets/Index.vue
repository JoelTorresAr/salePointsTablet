<template>
  <v-app>
    <v-app-bar app clipped-right style="height: 3rem;">
      <v-slide-group multiple show-arrows>
        <v-slide-item v-for="(item, index) in pisos" :key="index" v-slot:default="{ active }">
          <v-btn
            class="ma-2 white--text card card-block"
            tile
            :input-value="active"
            :color="item.id==pisoActual?'black':'light-green darken-4'"
            @click="getMesas(item.id)"
          >{{item.name}}</v-btn>
        </v-slide-item>
      </v-slide-group>
      <v-spacer></v-spacer>
      <v-switch v-model="switchNavegator" label="Opciones de mesa"></v-switch>
    </v-app-bar>
    <v-main app>
      <perfect-scrollbar>
        <v-col cols="12" v-show="loading">
          <app-spinner></app-spinner>
        </v-col>
        <v-card class="d-flex flex-wrap" flat tile>
          <v-card
            v-for="(item, index) in mesas"
            :key="index"
            :color="item.st_mesa=='L'?'success':'error'"
            dark
            height="6rem"
            width="8rem"
            class="pa-2 mt-4 ml-4 mr-3"
            @click="actionMesa(item,item.id)"
          >
            <v-card-title class="p-0">
              {{item.nombre}}
              <i v-show="showChecksinMesa(item)" :class="checkJoin(item.id)"></i>
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
    </v-main>
    <v-navigation-drawer
      v-if="switchNavegator"
      app
      permanent
      right
      clipped
      width="12rem"
      height="70vh"
    >
      <v-list dense>
        <v-list-item @click="actionButtons('JUNTAR')">
          <v-list-item-icon>
            <v-icon>fas fa-circle-notch</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{showJoins==true && actionButton==='JUNTAR'?'OK':'JUNTAR'}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="actionButtons('SEPARAR')">
          <v-list-item-icon>
            <v-icon>fas fa-circle-notch</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{showJoins==true && actionButton==='SEPARAR'?'OK':'SEPARAR'}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="actionButtons('MOVER')">
          <v-list-item-icon>
            <v-icon>fas fa-circle-notch</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{showJoins==true && actionButton==='MOVER'?'OK':'MOVER'}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-footer app class="text--accent-3" style="height: 3rem;">
      <span>{{user}}</span>
      <v-spacer></v-spacer>
      <v-btn
        class="ma-2 white--text mt-0"
        tile
        min-width="8rem"
        color="purple accent-4"
        @click="logout"
      >BLOQUEAR</v-btn>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    loading: true,
    showJoins: false,
    actionButton: "",
    switchNavegator: false,
    buttonKeys: [
      { accion: "JUNTAR", icon: "fas fa-circle-notch" },
      { accion: "COBRAR", icon: "fas fa-circle-notch" },
      { accion: "ELIMINAR", icon: "fas fa-circle-notch" },
      { accion: "SEPARAR", icon: "fas fa-circle-notch" },
      { accion: "MOVER", icon: "fas fa-circle-notch" }
    ],
    ip: "",
    config: undefined,
    user: "",
    pisos: "",
    pisoActual: "0",
    cajaId: undefined,
    mesas: "",
    mesaId: "",
    mesaActual: "",
    arrayMesas: [],
    pin: "",
    dialog: false,
    numcomen: 1
  }),
  watch: {
    pisos(val) {
      if (val.length > 0) {
        var index = val[0].id;
        if (this.pisoActual == "0") {
          this.getMesas(index);
        } else {
          this.getMesas(this.pisoActual);
        }
      }
    }
  },
  created() {
    this.pisos = JSON.parse(this.$store.getters.getPISOS);
    this.pin = this.$store.getters.getPIN;
    this.ip = this.$store.getters.getIP;
    this.user = this.$store.getters.getUSERNAME;
    this.pisoActual = this.$store.getters.getPISO_ACTUAL;
    this.cajaId = this.$store.getters.getCASH_BOX_ID;
    this.config = JSON.parse(this.$store.getters.getCONFIG_AXIOS);
  },
  methods: {
    getMesas(piso) {
      this.mesas = [];
      this.loading = true;
      this.pisoActual = piso;
      axios
        .post(
          `/api/tablet/mesas`,
          {
            caja: this.cajaId,
            piso: this.pisoActual
          },
          this.config
        )
        .then(({ data }) => {
          this.loading = false;
          this.mesas = data.mesas;
        })
        .catch(error => {
          if (error.response) {
            if (error.response.status === 401) {
              this.sesionCaducada();
            }
          } else if (error.request) {
            console.log(error.request);
          } else {
            console.log("Error", error.message);
          }
          // console.log(error.config);
        });
    },
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

        case "2":
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
            this.actionButton = "";
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
            this.actionButton = "";
            this.showJoins = !this.showJoins;
            this.moverMesas();
          } else {
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
              if (e.id == item.id) {
                existe = true;
                ix = e;
              }
            });
            if (existe) {
              var i = this.arrayMesas.indexOf(ix);
              this.arrayMesas.splice(i, 1);
            } else {
              var mesa = {
                id: item.id,
                id_cmd: item.id_cmd,
                st_cmd: item.st_cmd,
                st_join: 1
              };
              this.arrayMesas.push(mesa);
            }
          }
          break;
        case "SEPARAR":
          if (item.juntada == 1) {
            var existe = false;
            var ix;
            this.arrayMesas.forEach(e => {
              if (e.id == item.id) {
                existe = true;
                ix = e;
              }
            });
            if (existe) {
              this.arrayMesas = [];
            } else {
              var mesa = {
                id: item.id,
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
              if (e.id == item.id) {
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
                  id: item.id,
                  id_cmd: item.id_cmd,
                  st_cmd: item.st_cmd
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
    checkJoin(id) {
      var std = "";
      switch (this.actionButton) {
        case "JUNTAR":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == id) {
              std = "mdi mdi-checkbox-marked-outline";
            }
          });
          break;
        case "SEPARAR":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == id) {
              std = "mdi mdi-checkbox-marked-outline";
            }
          });
          break;
        case "MOVER":
          std = "mdi mdi-checkbox-blank-outline";
          this.arrayMesas.forEach(e => {
            if (e.id == id) {
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
          if (this.showJoins & (item.juntada == 1)) {
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
    newComanda(item, index) {
      this.mesaId = index;
      this.mesaActual = item;
      this.$store.commit("SET_MESA_ACTUAL", JSON.stringify(item));
      this.$store.commit("SET_ID_MESA_ACTUAL", index);
      var id = this.$store.getters.getUSERID;
      if (item.st_cmd == "") {
        this.dialog = true;
      } else {
        var url = `api/tablet/comanda/nueva`;
        axios
          .post(url, { id: this.mesaId }, this.config)
          .then(({ data }) => {
            if (data.status !== 0) {
              this.$router.push({ name: "Store" });
              this.$store.commit("SET_PISO_ACTUAL", this.pisoActual);
            } else {
              if (data.msg == "Comanda no existe") {
                this.swalMessage(data.msg);
                this.getMesas(this.pisoActual);
              } else {
                var name = this.$store.getters.getUSERNAME;
                var msg = `Comanda esta siendo Editada por mesero: ${name}`;
                if (data.msg != msg) {
                  Swal.fire({
                    title: "Advertencia!",
                    text: data.msg,
                    icon: "warning",
                    confirmButtonText: "OK"
                  });
                  this.getMesas(this.pisoActual);
                } else {
                  this.$router.push({ name: "Store" });
                  this.$store.commit("SET_PISO_ACTUAL", this.pisoActual);
                }
              }
            }
          })
          .catch(error => {
            if (error.response) {
              if (error.response.status === 401) {
                this.sesionCaducada();
              }
            } else if (error.request) {
              // console.log(error.request);
            } else {
              // console.log("Error", error.message);
            }
            // console.log(error.config);
          });
      }
    },
    unirMesas() {
      var id_cmd = [];
      var id_mesa = "";
      var id_mesas = [];
      this.arrayMesas.forEach(e => {
        if (e.id_cmd != null) {
          id_cmd.push(e.id_cmd);
          id_mesa = e.id;
        } else {
          id_mesas.push(e.id);
        }
      });
      var cant_cmd = id_cmd.length;
      if (cant_cmd == 1) {
        var url = `api/tablet/mesas/juntar`;
        axios
          .post(
            url,
            { id_mesa: id_mesa, mesas: id_mesas, id_cmd: id_cmd[0] },
            this.config
          )
          .then(({ data }) => {
            if (data.msg == "Ok") {
              this.arrayMesas = [];
              this.getMesas(this.pisoActual);
            } else {
              this.swalMessage(data.msg);
              this.getMesas(this.pisoActual);
              this.arrayMesas = [];
            }
          })
          .catch(error => {
            this.arrayMesas = [];
            console.log(error);
          });
      } else {
        if (cant_cmd > 1) {
          this.swalMessage("Seleccione solo una mesa que tenga comanda");
        } else {
          this.swalMessage("Seleecione al menos una mesa con comanda");
        }
      }
    },
    separarMesas() {
      var id_cmd = "";
      var id_mesa = "";
      this.arrayMesas.forEach(e => {
        if (e.id_cmd != 0) {
          id_cmd = e.id_cmd;
        }
        id_mesa = String(e.id);
      });
      var url = `api/tablet/mesas/separar`;
      axios
        .post(url, { id_mesa: id_mesa, id_cmd: id_cmd }, this.config)
        .then(({ data }) => {
          if (data.msg == "Ok") {
            this.arrayMesas = [];
            this.getMesas(this.pisoActual);
          } else {
            this.swalMessage(data.msg);
            this.getMesas(this.pisoActual);
            this.arrayMesas = [];
          }
        })
        .catch(error => {
          this.arrayMesas = [];
          console.log(error);
        });
    },
    moverMesas() {
      var id_cmd = "";
      var id_mesa = "";
      this.arrayMesas.forEach(e => {
        if (e.id_cmd != null) {
          id_cmd = e.id_cmd;
        } else {
          id_mesa = e.id;
        }
      });
      var url = `api/tablet/mesas/mover`;
      axios
        .post(url, { id_mesa: id_mesa, id_cmd: id_cmd }, this.config)
        .then(({ data }) => {
          if (data.msg == "Ok") {
            this.arrayMesas = [];
            this.getMesas(this.pisoActual);
          } else {
            this.swalMessage(data.msg);
            this.getMesas(this.pisoActual);
            this.arrayMesas = [];
          }
        })
        .catch(error => {
          this.arrayMesas = [];
          console.log(error);
        });
    },
    logout() {
      this.$store.commit("SET_PIN", null);
      this.$router.push({ name: "Login" });
    },
    sesionCaducada() {
      this.swalMessage("La sesion ha caducado");
      this.$store.commit("SET_PIN", null);
      this.$router.push({ name: "Login" });
    },
    swalMessage(msg, title = "Advertencia!", icon = "warning") {
      Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        confirmButtonText: "Ok"
      });
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
.mesa__header {
  display: flex;
  width: 95%;
  justify-content: space-between;
}
</style>