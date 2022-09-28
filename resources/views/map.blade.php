<html>
  <head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
        #map {
        height: 100%;
        }

        /*
        * Optional: Makes the sample page fill the window.
        */
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
    </style>
  </head>
  <body>
    <div id="map"></div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer>

      let map;
      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: -34.397, lng: 150.644 },
          zoom: 8,
        });
      }

      window.initMap = initMap;
    </script>
  </body>
</html>
