<template>
    <div class="container my-5">
        <h2 clas="text-center mb-5">{{establecimiento_fn.nombre}}</h2>

        <div class="row align-items start">
            <div class="col-md-8 order-2">
                <img :src="`../storage/${establecimiento_fn.imagen_principal}`" class="img-fluid" alt="Imagen establecimeinto">
                <p class="mt-3">{{establecimiento_fn.descripcion}}</p>

                <GaleriaImagenes></GaleriaImagenes>
            </div>
            <aside class="col-md-4 order-1">
                <div class="
                ">
                    <MapaUbicacion></MapaUbicacion>

                </div>
                <div class="p-4 bg-primary">
                    <h2 class="text-center text-white mt-2 mb-4">
                            Más información
                    </h2>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                                Ubicación:
                        </span>
                        {{establecimiento_fn.direccion}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                                Colonia:
                        </span>
                        {{establecimiento_fn.colonia}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                                Apertura:
                        </span>
                        {{establecimiento_fn.apertura}} - {{establecimiento_fn.cierre}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                                Telefóno:
                        </span>
                        {{establecimiento_fn.telefono}}
                    </p>
                </div>

            </aside>
        </div>
    </div>
</template>

<script>

// Importar compomentes
import MapaUbicacion from './mapaUbicacion';
import GaleriaImagenes from './galeriaImagenes';


export default {
    components:{
        MapaUbicacion,
        GaleriaImagenes
    },
    mounted(){
        // Obteer valores de los parametros enviados por el rraute
        // console.log(this.$route.params.id);

        // Aplicando destructuring
        const { id } = this.$route.params;

        axios.get(`/api/establecimientos/${id}`)
        .then(response => {
            // console.log(response.data);
            this.$store.commit('AGREGAR_ESTABLECIMIENTO', response.data);

        }).catch(error => {
            console.log(error);
        });

    },
    computed:{
         // Forma 1 hacerlo
        // establecimiento_fn() {
        //     return this.$store.state.establecimiento;
        // }

        // La otra es con gatter en el vueex

        // forma 2
        establecimiento_fn() {
            return this.$store.getters.obtenerEstablecimiento;
        }

    }
}
</script>
