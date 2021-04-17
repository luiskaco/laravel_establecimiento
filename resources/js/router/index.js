import Vue from 'vue';
import VueRouter from 'vue-router';

// Importamos vue-page-transicion
import VuePageTransition from 'vue-page-transition'

// Componentes importados
import InicioEstablecimiento from '../components/InicioEstablecimiento';
import MostrarEstablecimiento from '../components/MostrarEstablecimiento';


Vue.use(VueRouter); // instalar vue router en vue
Vue.use(VuePageTransition);

// Creacion de las rutas
const routes = [
    {
        path:'/',  // Al visitar esta ruta, cargamos el componentes
        component: InicioEstablecimiento
    },
    {
        path:'/establecimiento/:id',  //  Ruta con parametro a enviar
        name:"establecimiento",       // Ruta nombrada
        component: MostrarEstablecimiento
    }
];


const router = new VueRouter({
    mode: 'history', // Elimina el # en la url
    routes // Rutas que estamos registrando
});

export default router;
