// when the docs use an import:
import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();


if(document.querySelector('#mapa')){
    document.addEventListener('DOMContentLoaded', () => {

        const lat = document.querySelector("#lat").value !== '' ?   document.querySelector("#lat").value  :  -12.0644569;
        const lng = document.querySelector("#lng").value ? document.querySelector("#lng").value :-77.1113915;
        const apiKey  = 'AAPKd5e957b53beb44a4ba19f4de005bfa3eJbvY6KzVNzlf0tFgrPzPZElQ4xAAsnAl9XgGcyM_vwKHqVA7vaqawcBme3__stFV';

        const mapa = L.map('mapa').setView([lat, lng], 16);

        // Elimianr pines previus
        let markers = new L.FeatureGroup().addTo(mapa);


        // Capa lealeft
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable: true,
            autoPan:true
        }).addTo(mapa);

         // Asigar al contenedor de markers el nuevo pin
         markers.addLayer(marker);


          // Geocode Service esri
        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: apiKey // replace with your api key - https://developers.arcgis.com
          });
        // nota: Nos permite obtener la informaicon basado en la selecion de la coordernda


          // Buscador de direcciones
          const buscador = document.querySelector('#formbuscador');
                 //   buscador.addEventListener('input', buscarDireccion);
          buscador.addEventListener('blur', buscarDireccion);


          reuhicarPin(marker);

        // Funciones
        function reuhicarPin(marker){
            // Detectar movimiendo del marker
            marker.on('moveend', function(e){
                // console.log('Soltaste el pin');
                marker = e.target;

                const posicion = marker.getLatLng();

                // Centrar automaticamente
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng))

                // Reverse Geocoding, Cuando el usaurio con esri
                geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado) {
                    // console.log(error);
                    // console.log(resultado.address);
                    // Colocando popup
                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();

                    // Llenar los campos
                    LLenarInputs(resultado);
                })

            });
        }


       const LLenarInputs = resultado => {
            // console.log(resultado);
            document.querySelector("#direccion").value = resultado.address.Address || '';
            document.querySelector("#colonia").value = resultado.address.Neighborhood || '';
            document.querySelector("#lat").value = resultado.latlng.lat;
            document.querySelector("#lng").value = resultado.latlng.lng;
        }

        function buscarDireccion(e) {

            if(e.target.value.length> 10){

                // GeoSearch
                provider.search({query: `${e.target.value}`  }) // Peru PE
                    .then(resultado => {
                            //Evitando errores
                            if(resultado[0]){
                                // Limpiar los pines previus
                                markers.clearLayers();

                                // geoService Reverse
                                 let posicion = resultado[0].bounds[0];
                                 geocodeService.reverse().latlng(posicion, 16).run(function(error, result) {

                                    // Llenar los campos
                                    LLenarInputs(result);

                                    // Centrar el mapa
                                    mapa.setView(result.latlng);

                                    // Agregar el pin
                                    marker = new L.marker(result.latlng,{
                                        draggable: true,
                                        autoPan:true
                                    }).addTo(mapa);

                                    // Asigar al contenedor de markers el nuevo pin
                                    markers.addLayer(marker);

                                    // Mover el pin
                                    reuhicarPin(marker);
                                })

                            }

                    }).catch(error => {
                        console.log(error);
                    })



            }
        }


    }); // Document to ready

}


