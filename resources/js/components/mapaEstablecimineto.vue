<template>
    <div class="mapa">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution" />

            <l-marker
                v-for="establecimiento in establecimientos_fn"
                v-bind:key="establecimiento.id"
                :lat-lng="obtenerCoordenadas(establecimiento)"
                :icon="iconoEstablecimiento(establecimiento)"
                @click="redireccionar(establecimiento.id)"
            >
                <l-tooltip>
                    <div>
                        {{ establecimiento.nombre  }} - {{ establecimiento.categoria.nombre }}
                    </div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>


<script>
import { latLng } from 'leaflet'
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from 'vue2-leaflet';

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip,
        LIcon
    },
    data() {
        return {
            zoom: 13,
            center: latLng(-12.0644569, -77.1113915),
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            currentZoom: 11.5,
            currentCenter: latLng(-12.0644569, -77.1113915),
            showParagraph: false,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true
        };
    },
    created() {
        axios.get('/api/establecimientos')
            .then(response => {
                this.$store.commit('AGREGAR_ESTABLECIMIENTOS', response.data);
            }).catch(error => {
                console.log(error);
            });
    },
    computed: {
        establecimientos_fn() {
            return this.$store.getters.obtenerEstablecimientos
        },
    },
    methods: {
        obtenerCoordenadas(establecimiento) {
           return {
               lat: establecimiento.lat,
               lng: establecimiento.lng
           }
        },
          iconoEstablecimiento(establecimiento) {
              // Usando destrutrix
            const { slug } = establecimiento.categoria;

            // Pasando el compomentes a programar
           return L.icon({
               iconUrl: `images/iconos/${slug}.png`,  // Pasando los iconos con el nombre de la categoria  slug
               iconSize: [40,50] // Para dimensioanr los iconos
           })
        },
         redireccionar(id) {
             // Redireccion programada
            this.$router.push({ name: 'establecimiento', params: { id }})
        }
    },     // Es com un useEffect de react
    watch: {
            "$store.state.categoria": function() {
                //  console.log("la categoria ha cambiado");
                // console.log(this.$store.getters.obtenerCategoria);

                axios.get(`/api/todoscategorias/${this.$store.getters.obtenerCategoria}`)
                     .then(response => {
                        //  console.log(response.data);
                        this.$store.commit('AGREGAR_ESTABLECIMIENTOS', response.data);

                     })
                     .catch(error => {
                         console.log(error);
                     });
           }
        /**
         *  Nota: Va monitorear que parte del state ha cambiado
         */
    }
}
</script>

<style scoped>
.mapa {
    height: 600px;
    width: 100%;
}
</style>
