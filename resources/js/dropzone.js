const { default: Axios } = require("axios");

document.addEventListener('DOMContentLoaded', () => {


    if(document.querySelector('#dropzone')){

        Dropzone.autoDiscover = false; // Evitar que dropzone estancie la clase dropzone

        const dropzone = new Dropzone('div#dropzone',{
            url: "/imagen/store", // importante
            dictDefaultMessage: "Sube hasta 10 imagenes",
            maxFiles: 10,
            required:true,
            acceptedFiles:".png, .jpg, .gif, .bmp, .jpeg",
            addRemoveLinks:true, // Para habilitar la elimiancion de archivo
            dictRemoveFile: "Eliminar imagen",
            headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            init: function(){
                const galeria = document.querySelectorAll('.galeria');

                if(galeria.length>0){
                    galeria.forEach(imagen => {
                        imagenPublicada = {};
                        /* ESTOS DOS ATRIBUTOS SON NECESARIOS */
                        imagenPublicada.size = 1;
                        imagenPublicada.name = imagen.value;

                        // agregando ruta del servior de la iamgen
                        imagenPublicada.nombreServidor = imagen.value;
                        // AGREGALRO A DROPZON
                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`);
                        // console.log(Imagen);

                        // Agreegando clase
                        imagenPublicada.previewElement.classList.add('dz-success');
                        imagenPublicada.previewElement.classList.add('dz-complete');


                    })
                }
            },
            success: function(file, response){
                // console.log(file); // Cliente del servidor
                  console.log(response);

                // Guardando la ruta de la iamgen
                file.nombreServidor = response.archivo;
            },
            sending: function(file, xhr, formData){
                console.log("enviando");

                formData.append('uuid', document.querySelector("#uuid").value)
                // nota:  se ejcuta cuando se envia algo al servidor
            },
            removedfile: function(file, response){
                // Nota: Este metodo funciona  addRemoveLinks:true,
                // console.log(file);

                const params = {
                    imagen: file.nombreServidor,
                     uuid: document.querySelector("#uuid").value
                }


                axios.post('/imagen/destroy',  params)
                     .then(response => {
                        console.log(response);

                            // Eliminar del DOM
                            file.previewElement.parentNode.removeChild(file.previewElement);
                     })
                     .catch(error => {
                        console.log(response);
                     });

            }
        });
    }



});
