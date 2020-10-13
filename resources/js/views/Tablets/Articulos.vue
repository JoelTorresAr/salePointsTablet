<template>
  <v-app>
    <v-navigation-drawer app permanent fixed clipped width="35vw" height="70vh">
      <v-list-item v-for="(item, index) in artList" :key="index" class="pl-2 pr-2">
        <v-list-item-action class="mr-2">
          <div>
            <v-btn
              color="primary"
              fab
              x-small
              dark
              :disabled="disableMinusBtn"
              @click="alterList(item,'minus')"
            >
              <v-icon>mdi-minus</v-icon>
            </v-btn>
            {{item.cant}}
            <v-btn color="primary" fab x-small dark @click="alterList(item,'plus')">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </div>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-subtitle>
            <small>
              <b class="mifuente">{{ item.name }}</b>
            </small>
          </v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-action class="ml-2">
          <v-btn color="red" fab x-small dark @click="alterList(item,'remove')">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </v-navigation-drawer>
    <v-app-bar app clipped-left height="35vh">
      <v-toolbar-title>
        <strong>{{mesa.nombre}}</strong>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="salir" color="warning">
        <v-icon>mdi-arrow-left-bold</v-icon>
      </v-btn>
    </v-app-bar>
    <v-main app height="40vh">
      <v-toolbar dense min-width="65vw">
        <v-slide-group multiple show-arrows>
          <v-slide-item v-for="(item, index) in familias" :key="index" v-slot:default="{ active }">
            <v-btn
              class="ma-2 white--text card card-block"
              tile
              :input-value="active"
              color="light-blue darken-4"
              @click="getArticles(item)"
            >{{item.name}}</v-btn>
          </v-slide-item>
        </v-slide-group>
      </v-toolbar>
      <perfect-scrollbar>
        <v-card class="d-flex flex-wrap" flat tile>
          <v-card
            v-for="(item, index) in articulos"
            :key="index"
            color="orange lighten-4"
            dark
            width="10rem"
            height="8rem"
            class="pa-2 mt-4 ml-4"
            @click="addToMesa(item,index)"
          >
            <v-card-text class="black--text" style="height:5rem!important">{{item.name}}</v-card-text>
            <v-card-actions class="black">
              <strong>S/.{{item.total}}</strong>
            </v-card-actions>
          </v-card>
        </v-card>
      </perfect-scrollbar>
    </v-main>
    <v-footer app fixed class="text--accent-3" height="40vh">
      <strong class="subheading">Total: S/.{{ total}}</strong>
      <v-spacer></v-spacer>
      <v-btn
        v-for="key in buttonKeys"
        :key="key.accion"
        @click="actionButton(key.accion)"
        color="primary"
        class="mr-3 mt-0"
      >
        <v-icon large>{{key.icon}}</v-icon>
      </v-btn>
    </v-footer>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-text class="p-0">
          <v-container class="pt-0 pb-0">
            <v-row>
              <v-col cols="12" class="pt-0 pb-0">
                <v-text-field
                  class="centered-input display-1"
                  label="Ingrese nota de comanda"
                  type="text"
                  v-model="noteCmd"
                  :rules="[v => !!v || 'Ingrese una nota']"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions class="pt-0 pb-0">
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="addNote">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    switchNavegator: false,
    ip: "",
    familias: "",
    buttonKeys: [
      { accion: "cocina", icon: "mdi-pot-steam" },
      { accion: "anotacion", icon: "mdi-note-text-outline" },
      { accion: "precuenta", icon: "mdi-cash-register" }
    ],
    articulos: [],
    articlesEnMesa: [],
    mesa: "",
    mesaId: "",
    total: "",
    config: "",
    dialog: false,
    noteCmd: "",
    numcomen: 0,
    cantidad: 0,
    userID: 0,
    pin: undefined,
    disableMinusBtn: false
  }),
  computed: {
    artList() {
      return this.articlesEnMesa;
    }
  },
  created() {
    this.familias = JSON.parse(this.$store.getters.getFAMILIAS);
    this.mesa = JSON.parse(this.$store.getters.get_MESA_ACTUAL);
    this.mesaId = this.$store.getters.get_ID_MESA_ACTUAL;
    this.userID = this.$store.getters.getUSERID;
    this.config = JSON.parse(this.$store.getters.getCONFIG_AXIOS);
    this.getArticlesinMesa();
  },
  methods: {
    getArticles(fam) {
      this.articulos = [];
      this.articulos = fam.menus;
    },
    getArticlesinMesa() {
      var url = `api/tablet/comanda/item/listar`;
      axios
        .post(
          url,
          {
            id_mesa: this.mesaId
          },
          this.config
        )
        .then(({ data }) => {
          if (data.msg == "Ok") {
            this.articlesEnMesa = data.prod;
            this.total = data.total;
          } else {
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
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
    },
    addToMesa(item, index) {
      var url = `api/tablet/comanda/item/agregar `;
      axios
        .post(
          url,
          {
            id_mesa: this.mesaId,
            id_producto: item.id
          },
          this.config
        )
        .then(({ data }) => {
          if (data.msg == "Ok") {
            this.articlesEnMesa = data.prod;
            this.total = data.total;
          } else {
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
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
    },
    addNote() {
      var url = `api/tablet/comanda/nota`;
      axios
        .post(
          url,
          {
            id_mesa: this.mesaId,
            nota: this.noteCmd
          },
          this.config
        )
        .then(({ data }) => {
          this.dialog = false;
          if (data.msg == "OK") {
            this.noteCmd = "";
          } else {
            console.log(data);
            this.noteCmd = "";
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    alterList(item, action) {
      var cant = 1;
      switch (action) {
        case "minus":
          this.disableMinusBtn = true;
          cant = -1;
          if (item.print == 1 && item.increment < 1) {
            this.swalValidator(this.mesaId, item.idprod, item.id, cant);
          } else {
            this.consultaAlterarLista(this.mesaId, item.idprod, item.id, cant);
          }
          break;
        case "remove":
          cant = 0;
          if (action == "remove" && item.print == 1) {
            this.swalValidator(this.mesaId, item.idprod, item.id, cant);
          } else {
            this.consultaAlterarLista(this.mesaId, item.idprod, item.id, cant);
          }
          break;
        default:
          this.consultaAlterarLista(this.mesaId, item.idprod, item.id, cant);
      }
    },
    consultaAlterarLista(
      id_mesa,
      id_prod,
      id_detalle,
      cant,
      restring = false,
      auth = ""
    ) {
      var url = `api/tablet/comanda/item/alterar`;
      axios
        .post(
          url,
          {
            id_mesa: id_mesa,
            id_producto: id_prod,
            id_detalle: id_detalle,
            cantidad: cant,
            restring: restring,
            auth: auth
          },
          this.config
        )
        .then(({ data }) => {
          this.disableMinusBtn = false;
          if (data.msg == "Ok") {
            this.articlesEnMesa = data.prod;
            this.total = data.total;
          } else {
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
          }
        })
        .catch(error => {
          this.disableMinusBtn = false;
          if (error.response) {
            if (error.response.status === 401) {
              this.sesionCaducada();
            }
          } else if (error.request) {
            // console.log(error.request);
          } else {
            // console.log("Error", error.message);
            Swal.fire({
              title: "Advertencia!",
              text: error.message.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
          }
          // console.log(error.config);
        });
    },
    actionButton(val) {
      switch (val) {
        case "cocina":
          this.sendKitchen();
          break;
        case "precuenta":
          this.sendPrecuenta();
          break;
        case "anotacion":
          this.dialog = true;
          break;

        default:
          break;
      }
    },
    sendKitchen() {
      var url = `api/tablet/comanda/imprimir/cocina`;
      //console.log(url)
      let user = this.$store.getters.getUSERNAME;
      const store_id = this.$store.getters.getSTORE_ID;
      axios
        .post(
          url,
          {
            id_mesa: this.mesaId,
            mesa: this.mesa.nombre,
            mozo: user,
            user_id: this.userID,
            tipo: "cocina",
            shop_id: store_id
          },
          this.config
        )
        .then(({ data }) => {
          if (data.msg == "OK") {
            Swal.fire({
              title: "Enviado a cocina!",
              text: data.msg,
              icon: "success",
              confirmButtonText: "OK"
            });
            this.salir();
          } else {
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            });
          }
        })
        .catch(error => {
          if (error.response) {
            if (error.response.status === 401) {
              this.sesionCaducada();
            }
          }
        });
    },
    sendPrecuenta() {
      var sinEnviarCocina = 0;
      this.articlesEnMesa.forEach(element => {
        if (element.increment > 0) {
          sinEnviarCocina++;
        }
      });
      if (sinEnviarCocina == 0) {
        var url = `api/tablet/comanda/imprimir/precuenta`;
        let user = this.$store.getters.getUSERNAME;
        axios
          .post(
            url,
            {
              id_mesa: this.mesaId,
              mesa: this.mesa.nombre,
              mozo: user,
              user_id: this.userID,
              tipo: "precuenta"
            },
            this.config
          )
          .then(({ data }) => {
            if (data.msg == "OK") {
              this.$router.push({ name: "Home" });
              this.articlesEnMesa = data.prod;
              this.total = data.total;
              // this.salir();
            } else {
              Swal.fire({
                title: "Advertencia!",
                text: data.msg,
                icon: "warning",
                confirmButtonText: "OK"
              });
            }
          })
          .catch(error => {
            if (error.response) {
              if (error.response.status === 401) {
                this.sesionCaducada();
              }
            }
          });
      } else {
        Swal.fire({
          title: "Advertencia!",
          text:
            "Tiene detalles sin eliminar a cocina, eliminelos o envielos a cocina",
          icon: "warning",
          confirmButtonText: "OK"
        });
      }
    },
    salir() {
      var url = `api/tablet/comanda/liberar`;
      axios
        .post(
          url,
          {
            id_mesa: this.mesaId
          },
          this.config
        )
        .then(({ data }) => {
          if (data.msg == "Ok") {
            this.$router.push({ name: "Home" });
          } else {
            Swal.fire({
              title: "Advertencia!",
              text: data.msg,
              icon: "warning",
              confirmButtonText: "OK"
            }).then(result => {
              if (result.value) {
                this.$router.push({ name: "Home" });
              }
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    sesionCaducada() {
      Swal.fire({
        title: "Advertencia!",
        text: "La sesion ha caducado",
        icon: "warning",
        confirmButtonText: "OK"
      });
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
    },
    swalValidator(id_mesa, id_prod, id_detall, cant) {
      const { value: pin } = Swal.fire({
        title: "Esta accion requiere autorización",
        input: "text",
        inputValue: "",
        showCancelButton: true,
        inputValidator: value => {
          if (!value) {
            return "Necesitas ingresar el pin de un administrador!";
          }
          {
            this.consultaAlterarLista(
              id_mesa,
              id_prod,
              id_detall,
              cant,
              true,
              value
            );
          }
        }
      }).then(result => {
        if (result.dismiss === Swal.DismissReason.cancel) {
          this.disableMinusBtn = false;
        }
      });
    }
  }
};
</script>
<style>
.mifuente {
  font-size: 1.3vw;
  font-weight: bold;
}
</style>