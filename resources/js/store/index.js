import Vue from 'vue';
import Vuex from 'vuex';

// instalamos vuex
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
        establecimiento:{},
        establecimientos:[], // Listo establecimeintos en el mapa global
        categorias:[], // Listo categorias en el menu
        categoria: '', // Filtro categoria
    },
    mutations: {
        AGREGAR_CAFES(state, cafes) {
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state, restaurantes){
            state.restaurantes = restaurantes;
        },
        AGREGAR_HOTELES(state, hoteles) {
            state.hoteles = hoteles;
        },
        AGREGAR_ESTABLECIMIENTO(state, establecimeinto){
            state.establecimiento = establecimeinto;
        },
        AGREGAR_ESTABLECIMIENTOS(state, establecimientos){
            // Todos los establecimientos
            state.establecimientos = establecimientos;
        },
        AGREGAR_CATEGORIA(state, categorias) {
            state.categorias = categorias;
        },
        SELECIONAR_CATEGORIA(state, categoria){
            state.categoria = categoria;
        }

    },
    // forma 2 usando getter
    getters:{
        obtenerEstablecimiento: state => {
            return state.establecimiento;
        },
        obtenerImagenes: state => {
            return state.establecimiento.imagenes;  //Obtenemos las iamgenes
        },
        obtenerEstablecimientos: state => {
            return state.establecimientos;
        },
        obtenerCategorias: state => {
            return state.categorias
        },
        obtenerCategoria: state => {
            return state.categoria
        }
    }
});

/**
 * Nota: solo va server para manejar el state
 */
