<template>
    <div>
        <ListadoCategoria></ListadoCategoria>
        <MapaEstablecimiento></MapaEstablecimiento>
        <Categoria-Cafe></Categoria-Cafe>
        <Categoria-Restaurant></Categoria-Restaurant>
        <Categoria-Hotel></Categoria-Hotel>
    </div>
</template>
<script>

    // Importando componentes
    import ListadoCategoria from './listadoCategoria';
    import MapaEstablecimiento from './mapaEstablecimineto';
    import CategoriaCafe from './categoriaCafe';
    import CategoriaRestaurant from './categoriaRestaurant';
    import CategoriaHotel from './CategoriaHotel';

    export default {

        components: {
            // Registando compnnentes
            MapaEstablecimiento,
            CategoriaCafe,
            CategoriaRestaurant,
            CategoriaHotel,
            ListadoCategoria

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
