<template>
    <div class="mapa">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution" />
            <!--
                Notas: El componente  LtitleLayot y los prop url y attribution son necesarias -->

                <l-marker
                    :lat-lng="{lat, lng}"
                >
                    <l-tooltip>
                        <div>{{ establecimiento_fn.nombre}}</div>
                    </l-tooltip>
                </l-marker>
        </l-map>
    </div>
</template>

<script>
import { latLng } from 'leaflet'; // SInstalando dependeas de soporte
import { LMap, LTileLayer, LMarker, LTooltip} from 'vue2-leaflet';

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip

    },
      data() {
                return {
                        zoom: 16,
                        center: latLng(-12.0644569, -77.1113915),
                        url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                        attribution:
                            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                        currentZoom: 11.5,
                        mapOptions: {
                            zoomSnap: 0.5
                        },
                        showMap: true,
                        lat: "",
                        lng: ""
                    };
    },
    created(){
        setTimeout(() => {
            this.lat = this.$store.getters.obtenerEstablecimiento.lat;
            this.lng = this.$store.getters.obtenerEstablecimiento.lng;
            this.center = latLng(this.lat, this.lng);
        }, 1000);
    },
      computed:{

        // forma 2
         establecimiento_fn() {
            return this.$store.getters.obtenerEstablecimiento;
        }

    }
}
</script>


<style scope>
     /* Nota: Solo carga dentro del componente */
     @import url("https://unpkg.com/leaflet@1.7.1/dist/leaflet.css");

    .mapa {
        height: 300px;
        width: 100%;
    }
</style>
