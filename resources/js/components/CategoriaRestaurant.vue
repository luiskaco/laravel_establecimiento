<template>
    <div class="container my-5">
        <h2>Restaurantes</h2>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="restaurant in this.restaurants_fn"
                v-bind:key="restaurant.id">

                <div class="card">
                    <img :src="`storage/${restaurant.imagen_principal}`" class="card-img-top" alt="card del restaurant">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold">
                            {{restaurant.nombre}}
                        </h3>
                        <p class="card-text">
                            {{restaurant.direccion}}
                        </p>
                        <p class="card-text">
                           <span class="font-weight-bold">Horario:</span>
                           {{restaurant.apertura}} - {{restaurant.cierre}}
                        </p>

                          <!-- Nota: componente de router link -->
                        <router-link :to="{ name: 'establecimiento' , params: { id: restaurant.id} }">
                            <a  class="btn btn-primary d-block">Ver Lugar</a>
                        </router-link>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

//   Nota: para agregar valor unico  en un elemento usamos  v-bind:key="cafe.id"
// :src cuando son valroes dinamico
export default {
    mounted: function(){
        axios.get('/api/categorias/restaurant')
            .then(response => {
                // console.log(response.data);
                this.$store.commit("AGREGAR_RESTAURANTES", response.data);
            });
    },
    computed: {
        restaurants_fn(){ // nombre del v for
            return this.$store.state.restaurantes;
        }

    }

}

/**
 * Nota: por la forma que trabaja vue, no puede usar arrow function
 */
</script>
