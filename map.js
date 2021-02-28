let map;
      let infoWindow;
      var labels = {
        Plumber: "P",
        Electrician: "E",
        Landscaping: "L",
        Carpenter: "C",
        Roofing: "R"
      }
      var icons = {
        Plumber: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
        Electrician: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
        Landscaping: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
        Carpenter: "http://maps.google.com/mapfiles/ms/icons/pink-dot.png",
        Roofing: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
      }



      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: new google.maps.LatLng(32.991289, -96.742944),
        }); 
        // Create a <script> tag and set the USGS URL as the source.
        const script = document.createElement("script");

        infoWindow = new google.maps.InfoWindow

        script.src = "points.js";
        document.getElementsByTagName("head")[0].appendChild(script);
      }

      // Loop through the results array and place a marker for each
      // set of coordinates.


      const eqfeed_callback = function (results) {

        for (let i = 0; i < results.features.length; i++) {

          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1], coords[0]);
          var infowincontent = document.createElement('div');
          var strong = document.createElement('strong');
          strong.textContent = results.features[i].properties.Service
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('text');
          text.textContent = results.features[i].properties["Contact Info"];
          infowincontent.appendChild(text);

          var marker = new google.maps.Marker({
            position: latLng,
            map: map,
      //      label: labels[results.features[i].properties.Service],
              icon: {
                url: icons[results.features[i].properties.Service]
              }
          });


          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        }
      };
