<template>
  <div>
    <v-toolbar dense>
      <v-slide-group multiple show-arrows>
        <v-slide-item v-for="(item, index) in familias" :key="index" v-slot:default="{ active }">
          <v-btn
            class="ma-2 white--text card card-block"
            tile
            :input-value="active"
            color="light-blue darken-4"
            @click="getArticles(item)"
          >{{item.nombre}}</v-btn>
        </v-slide-item>
      </v-slide-group>
    </v-toolbar>
    <perfect-scrollbar>
      <v-card class="d-flex flex-wrap oscuro" flat tile>
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
          <v-card-text class="black--text" style="height:5rem!important">{{item.nombre}}</v-card-text>
          <v-card-actions class="black">
            <strong>S/.{{item.precio}}</strong>
          </v-card-actions>
        </v-card>
      </v-card>
    </perfect-scrollbar>
  </div>
</template>

<script>
export default {
  data: () => ({
    familias: [],
    articulos: []
  }),
  created() {
    this.getFamilias();
  },
  methods: {
    getFamilias() {
      this.familias = [
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        },
        {
          nombre: "PRUEBA 1"
        }
      ];
    },
    getArticles(item){
        this.articulos = [
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            {nombre: 'Articulo 1',precio: 10.2},
            ]
    },
  }
};
</script>

<style>
</style>