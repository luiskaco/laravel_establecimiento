<template>
    <div>
        <!-- Nota:transiciones fade, zoom , overlay -->
        <vue-page-transition
            name="fade-in-right"
        >
            <router-view/>
        </vue-page-transition>

    </div>
</template>

<script>

    // importando el Store | redux
    import store from '../store';

    export default {
        store
    }

    // export default {
    //     store,

    //     components: {
    //         CategoriaCafe,
    //         CategoriaRestaurant,
    //         CategoriaHotel
    //     },
    //     mounted() {
    //         console.log('Component mounted.')
    //     }
    // }
</script>
