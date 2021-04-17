<template>
    <div>
        <nav class="d-flex flex-column flex-md-row container justify-content-md-center">
            <a
                @click="selecioanrTodos()"
            >Todos</a>
            <a
                v-for="categoria in categorias_fn"
                v-bind:key="categoria.id"
                class="m-0"
                @click="selecionarCategoria(categoria)"
            >
                {{categoria.nombre}}
            </a>
        </nav>
    </div>

</template>

<script>
export default {
        // Cuando el componente este creado
        async created() {
            await axios.get(`/api/categorias`)
                  .then(response => {
                    //   console.log(response.data);

                      this.$store.commit('AGREGAR_CATEGORIA',response.data);
                  })
                  .catch(error => {
                      console.log(error);
                  });
        },
        computed:{
            // Ejecutandos cuando el compontne este listo
            categorias_fn(){
                return this.$store.getters.obtenerCategorias;
            }
        },
        methods:{
            selecionarCategoria(categoria){
                // console.log(categoria.slug);
                this.$store.commit('SELECIONAR_CATEGORIA', categoria.slug);
            },
            selecioanrTodos(){
                  axios.get('/api/establecimientos')
                .then(response => {
                    this.$store.commit('AGREGAR_ESTABLECIMIENTOS', response.data);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
}
</script>


<style scoped>
    div {
        background-color: #6272d4;
    }
    nav a {
        color: white !important;
        font-weight: bold;
        text-transform: uppercase;
        padding: 0.5rem 2rem;
        text-align: center;
        flex: 1;
    }
    nav a:hover {
        color: white;
        cursor: pointer;
    }
    nav a:nth-child(1) {
         background-color: #a000b7;
    }
    nav a:nth-child(2) {
        background-color: #591d03;
    }
    nav a:nth-child(3) {
         background-color: #ea6a00;
    }
    nav a:nth-child(4) {
         background-color: #edb220;
    }
    nav a:nth-child(5) {
        background-color: #dd0e3f;
    }
    nav a:nth-child(6) {
         background-color: #0448b5;
    }
    nav a:nth-child(7) {
        background-color: #00a81c;
    }
     nav a:nth-child(8) {
        background-color: #e772ce;
    }

</style>
