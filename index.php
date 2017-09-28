

<!DOCTYPE html >
  <head>
   <meta charset="utf-8">
    <title>Gescea - Rede Médica</title>
    <meta name="description" content="Rede de Médicos">
    <meta name="author" content="Thiago Braga">
    <meta name="keyword" content="GESCEA">
    <!-- end: Meta -->
    
    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/asset/css/font-awesome.min.css">

  <link rel="stylesheet" href="public/asset/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./video/mediaelementplayer.css">



  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="public/asset/js/angular.min.js"></script>


    <script>
      var listUserApp = angular.module('listUserApp', []);
      listUserApp.controller('userApp', ['$scope', '$http', function (scope, http){
        http.get('includes/admin').success(function(data) {
          scope.countries = data;
        });
      }]);
    </script>


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <script>

	var padrao = ('https://pai.thiagobraga.info/centena/img/pae3.png');
  var image1 = ('https://pai.thiagobraga.info/centena/img/pae.png');
  var image2 = ('https://pai.thiagobraga.info/centena/img/pae.png');
    
      var customLabel = {
        Medico: {
          label: '',
          icon: padrao
          
        },
        on: {
          //label: 'Fernanda',
          color: 'red',
          icon: image1
        },

         on2: {
          //label: 'Gustavo',
          color: 'red',
          icon: image2
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-22.9142212, -43.5890166),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://pai.thiagobraga.info/centena/maps.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var cns = markerElem.getAttribute('cns');
              var especialidade = markerElem.getAttribute('especialidade');
              var cel = markerElem.getAttribute('cel');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');

              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = 'Cel: '+cel
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));


              var text2 = document.createElement('text');
              text2.textContent = 'CNS: '+cns,
              infowincontent.appendChild(text2);
              infowincontent.appendChild(document.createElement('br'));

              var text3 = document.createElement('text');
              text3.textContent = 'Especialidade: '+especialidade,
              infowincontent.appendChild(text3);
              infowincontent.appendChild(document.createElement('br'));

               var text4 = document.createElement('text');
              text4.textContent = 'Endereço: '+address
              infowincontent.appendChild(text4);

              

              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB61T9rIphb-uq8qkB6_sRmo5LnYREMVZs&callback=initMap">
    </script>









  </body>
</html>