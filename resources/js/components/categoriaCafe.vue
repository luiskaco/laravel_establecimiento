<template>
    <div class="container my-5">
        <h2>Cafes</h2>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="cafe in this.cafes_fn"
                v-bind:key="cafe.id"

                >

                <div class="card">
                    <img :src="`storage/${cafe.imagen_principal}`" class="card-img-top" alt="card del restaurant">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold">
                            {{cafe.nombre}}
                        </h3>
                        <p class="card-text">
                            {{cafe.direccion}}
                        </p>
                        <p class="card-text">
                           <span class="font-weight-bold">Horario:</span>
                           {{cafe.apertura}} - {{cafe.cierre}}
                        </p>

                        <!-- Nota: componente de router link -->
                        <router-link :to="{ name: 'establecimiento' , params: { id: cafe.id} }">
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
    // data: function() {
    //     return {
    //     }
    // },
    mounted: function(){ // Una vez el compoente este cargado

        axios.get('/api/categorias/cafe')
            .then(response => {
                // console.log(response.data);
                // this.cafes = response.data;

                // Pasamos al store     | Especificamso la mutacion
                this.$store.commit('AGREGAR_CAFES', response.data)
            });

    },
    computed: {
        // PAra Acceder al store
        cafes_fn(){
            return this.$store.state.cafes;
        }
    }
}

// PAsos | redux
// 1- Carga el componente
// 2- Luego ejecuta el axios
// 3- hace un comit alstore
// 4- Captura el state y los datos
// 5- Llena el state

/**
 * Nota: por la forma que trabaja vue, no puede usar arrow function
 */
</script>
