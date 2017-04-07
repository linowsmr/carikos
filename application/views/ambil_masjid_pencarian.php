<?php
    foreach($detail as $row){ 
        $latlong = substr($row->latLngCluster, 1, -1);
        $coord = explode(", ", $latlong);
        $lat = $coord[0];
        $lng = $coord[1];
        $idCluster = $row->idCluster;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      #map {
        height: 0%;
      }
      .loader {
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid blue;
          border-right: 16px solid green;
          border-bottom: 16px solid red;
          border-left: 16px solid pink;
          width: 120px;
          height: 120px;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;

        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div>
        <div style="position: absolute; top: 30%; left: 45%;">
            <h2 style="margin-left: -19%;">Harap Menunggu</h2>
            <br>
            <div class="loader"></div>
        </div>
        <aside class="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="container">
                            <div class="row">
                                <div id="map"></div>
                            </div>
                            <script>
                                var map;
                                var service;
                                var array = [];

                                function initMap() {
                                  map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>},
                                    zoom: 16,
                                    styles: [{
                                      stylers: [{ visibility: 'simplified' }]
                                    }, {
                                      elementType: 'labels',
                                      stylers: [{ visibility: 'off' }]
                                    }]
                                  });

                                  service = new google.maps.places.PlacesService(map);

                                  // The idle event is a debounced event, so we can query & listen without
                                  // throwing too many requests at the server.
                                  map.addListener('idle', performSearch);
                                }

                                function performSearch() {
                                  var request = {
                                    bounds: map.getBounds(),
                                    keyword: 'Masjid'
                                  };
                                  service.radarSearch(request, callback);
                                }

                                function callback(results, status) {
                                  if (status !== google.maps.places.PlacesServiceStatus.OK) {
                                    console.error(status);
                                    return;
                                  }
                                  for (var i = 0, result; result = results[i]; i++) {
                                    var origin = {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>};
                                    var destination = result.geometry.location;

                                    getDistance(origin, destination);
                                  }
                                }

                                function getDistance(origin, destination){
                                  var geocoder = new google.maps.Geocoder;
                                  var service = new google.maps.DistanceMatrixService;
                                  service.getDistanceMatrix({
                                    origins: [origin],
                                    destinations: [destination],
                                    travelMode: google.maps.TravelMode.DRIVING,
                                    unitSystem: google.maps.UnitSystem.METRIC
                                  }, function(response, status) {
                                    if (status !== google.maps.DistanceMatrixStatus.OK) {
                                      alert('Error was: ' + status);
                                    } else {
                                      var originList = response.originAddresses;
                                      var destinationList = response.destinationAddresses;
                                      
                                      for (var i = 0; i < originList.length; i++) {
                                        var results = response.rows[i].elements;
                                        for (var j = 0; j < results.length; j++) {
                                          var element = results[j];
                                          if(element.distance.text.slice(-1) == "m")
                                            var distance = element.distance.value/1000;
                                          else
                                            var distance = element.distance.value;
                                          
                                          //console.log(distance);
                                          //if(distance < 5){
                                            if(array.length == 0)
                                                var newItem = array.push(distance);
                                            else if(array[0] > distance)
                                                array[0] = distance;
                                          //}
                                        }
                                      }
                                    }
                                    //console.log(array[0]);
                                    form(array[0]);
                                  });
                                }

                                function form(num)
                                {
                                    // Fetching HTML Elements in Variables by ID.
                                    var x = document.getElementById("form");
                                    var createform = document.createElement('form'); // Create New Element Form
                                    createform.setAttribute("action", "<?php echo site_url('cluster/cluster_data_masjid_pencarian')?>"); // Setting Action Attribute on Form
                                    createform.setAttribute("method", "post"); // Setting Method Attribute on Form
                                    x.appendChild(createform);

                                    var linebreak = document.createElement('br');
                                    createform.appendChild(linebreak);

                                    var idKos = document.createElement('label'); // Create Label for Name Field
                                    idKos.innerHTML = "Kos ID : "; // Set Field Labels
                                    createform.appendChild(idKos);

                                    var idKosElement = document.createElement('input'); // Create Input Field for Name
                                    idKosElement.setAttribute("type", "text");
                                    idKosElement.setAttribute("name", "kos");
                                    idKosElement.setAttribute("value", "<?php echo $idKos ?>");
                                    createform.appendChild(idKosElement);

                                    var messagebreak = document.createElement('br');
                                    createform.appendChild(messagebreak);

                                    var idCluster = document.createElement('label'); // Create Label for Name Field
                                    idCluster.innerHTML = "Cluster ID : "; // Set Field Labels
                                    createform.appendChild(idCluster);

                                    var idClusterElement = document.createElement('input'); // Create Input Field for Name
                                    idClusterElement.setAttribute("type", "text");
                                    idClusterElement.setAttribute("name", "cluster");
                                    idClusterElement.setAttribute("value", "<?php echo $idCluster ?>");
                                    createform.appendChild(idClusterElement);

                                    var messagebreak = document.createElement('br');
                                    createform.appendChild(messagebreak);

                                    var idDestination = document.createElement('label'); // Create Label for Name Field
                                    idDestination.innerHTML = "Destination ID : "; // Set Field Labels
                                    createform.appendChild(idDestination);

                                    var idDestinationElement = document.createElement('input'); // Create Input Field for Name
                                    idDestinationElement.setAttribute("type", "text");
                                    idDestinationElement.setAttribute("name", "destination");
                                    idDestinationElement.setAttribute("value", 3);
                                    createform.appendChild(idDestinationElement);

                                    var messagebreak = document.createElement('br');
                                    createform.appendChild(messagebreak);

                                    var namelabel = document.createElement('label'); // Create Label for Name Field
                                    namelabel.innerHTML = "Your Name : "; // Set Field Labels
                                    createform.appendChild(namelabel);

                                    var inputelement = document.createElement('input'); // Create Input Field for Name
                                    inputelement.setAttribute("type", "text");
                                    inputelement.setAttribute("name", "distance");
                                    inputelement.setAttribute("value", num);
                                    createform.appendChild(inputelement);

                                    var messagebreak = document.createElement('br');
                                    createform.appendChild(messagebreak);

                                    var submitelement = document.createElement('input'); // Append Submit Button
                                    submitelement.setAttribute("type", "submit");
                                    submitelement.setAttribute("value", "Submit");
                                    createform.appendChild(submitelement);

                                    createform.submit();
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap&libraries=places,visualization" async defer></script>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <aside class="call-to-action bg-primary" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div id="form" style="color: black;"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</body>

</html>