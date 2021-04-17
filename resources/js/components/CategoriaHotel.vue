<template>
    <div class="container my-5">
        <h2>Hoteles</h2>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="hotel in this.hoteles_fn"
                v-bind:key="hotel.id"

                >

                <div class="card">
                    <img :src="`storage/${hotel.imagen_principal}`" class="card-img-top" alt="card del hotel">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold">
                            {{hotel.nombre}}
                        </h3>
                        <p class="card-text">
                            {{hotel.direccion}}
                        </p>
                        <p class="card-text">
                           <span class="font-weight-bold">Horario:</span>
                           {{hotel.apertura}} - {{hotel.cierre}}
                        </p>

                          <!-- Nota: componente de router link -->
                        <router-link :to="{ name: 'establecimiento' , params: { id: hotel.id} }">
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
        axios.get('/api/categorias/Hotel')
            .then(response => {
                // console.log(response.data);
                // this.hoteles = response.data;
                this.$store.commit('AGREGAR_HOTELES', response.data);
            });
    },
    computed:{
        hoteles_fn(){
            return this.$store.state.hoteles;
        }
    }
}

/**
 * Nota: por la forma que trabaja vue, no puede usar arrow function
 */
</script>
