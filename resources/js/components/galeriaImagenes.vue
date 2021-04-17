<template>
    <div>
        <h2 class="mt-4">Galerias de Imagenes</h2>
        <ul class="row list-unstyled mt-4">
            <li
                v-for="imagen in imagenes_fn"
                v-bind:key="imagen.id"
                class="col-md-4 mb-4"
                >

                <a :href='`/storage/${imagen.ruta_imagen}`' data-lightbox="imagenes" data-title="imagen Establecimiento">
                    <img class="img-fluid" :src='`/storage/${imagen.ruta_imagen}`' alt='`imagen-${imagen.id}`'>
                </a>



            </li>
        </ul>
    </div>
</template>

<script>
// Importnado el arshivo de ligbox solo en el componente
import Lightbox from 'lightbox2';

export default {
    computed: {
        imagenes_fn(){
            return this.$store.getters.obtenerImagenes
        }
    }
}
</script>

<style scope>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css");
</style>
