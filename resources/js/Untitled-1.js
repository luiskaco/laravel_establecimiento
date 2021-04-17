
         const lat = -12.0644569;
         const lng = -77.1113915;

   var mapa = L.map("mapa").setView([lat, lng], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

      // create the geocoding control and add it to the map
      var searchControl = L.esri.Geocoding.geosearch({
        providers: [
          L.esri.Geocoding.arcgisOnlineProvider({
            // API Key to be passed to the ArcGIS Online Geocoding Service
            apikey: 'AAPKd5e957b53beb44a4ba19f4de005bfa3eJbvY6KzVNzlf0tFgrPzPZElQ4xAAsnAl9XgGcyM_vwKHqVA7vaqawcBme3__stFV'
          })
        ]
      }).addTo(mapa);

      // create an empty layer group to store the results and add it to the map
      var results = L.layerGroup().addTo(mapa);

      // listen for the results event and add every result to the map
      searchControl.on("results", function (data) {
        results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
          results.addLayer(L.marker(data.results[i].latlng));
        }
      });
