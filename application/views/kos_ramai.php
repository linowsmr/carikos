<?php
    foreach($kos as $row){
        $idKos = $row->idKos;
        $latlong = substr($row->latLngKos, 1, -1);
        $coord = explode(", ", $latlong);
        $lat = $coord[0];
        $lng = $coord[1];
    }
?>
<!DOCTYPE html>
<html>
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
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>},
          mapTypeId: 'terrain'
        });

        var ramai = [
          {lat: -7.275016, lng: 112.797509},
          {lat: -7.262736, lng: 112.795167},
          {lat: -7.258424, lng: 112.795192},
          {lat: -7.258328, lng: 112.795771},
          {lat: -7.262715, lng: 112.795693},
          {lat: -7.274088, lng: 112.798129},
          {lat: -7.273944, lng: 112.800928},
          {lat: -7.273944, lng: 112.800928},
          {lat: -7.275051, lng: 112.801196},
          {lat: -7.275849, lng: 112.802108},
          {lat: -7.277137, lng: 112.802484},
          {lat: -7.280660, lng: 112.802666},
          {lat: -7.282465, lng: 112.802920},
          {lat: -7.283877, lng: 112.802750},
          {lat: -7.284234, lng: 112.801873},
          {lat: -7.290332, lng: 112.799904},
          {lat: -7.291098, lng: 112.802039},
          {lat: -7.292678, lng: 112.801878},
          {lat: -7.292657, lng: 112.801669},
          {lat: -7.291438, lng: 112.801792},
          {lat: -7.291172, lng: 112.801653},
          {lat: -7.290005, lng: 112.798498},
          {lat: -7.290388, lng: 112.796593},
          {lat: -7.290792, lng: 112.791840},
          {lat: -7.290451, lng: 112.791851},
          {lat: -7.290004, lng: 112.796443},
          {lat: -7.289663, lng: 112.798524},
          {lat: -7.290142, lng: 112.799629},
          {lat: -7.284033, lng: 112.801646},
          {lat: -7.283639, lng: 112.802515},
          {lat: -7.277413, lng: 112.802139},
          {lat: -7.276008, lng: 112.801603},
          {lat: -7.275199, lng: 112.800659},
          {lat: -7.274465, lng: 112.800530},
          {lat: -7.275016, lng: 112.797509}
        ];

        var ramaiPolygon = new google.maps.Polygon({
            paths: ramai
        });
      
        //ramaiPolygon.setMap(map);
        var marker = new google.maps.Marker({
          position: {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>},
          map: map
        });

        if(google.maps.geometry.poly.containsLocation(marker.getPosition(), ramaiPolygon) == false){
          form(100);
        }
        else{
          form(0);
        }
      }

      function form(nilai) {
        var x = document.getElementById("form");
        var createform = document.createElement('form'); // Create New Element Form
        createform.setAttribute("action", "<?php echo site_url('cluster/kos_ramai')?>"); // Setting Action Attribute on Form
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
        idKosElement.setAttribute("value", "<?php Print($idKos); ?>");
        createform.appendChild(idKosElement);

        var messagebreak = document.createElement('br');
        createform.appendChild(messagebreak);

        var nilaiRamai = document.createElement('label'); // Create Label for Name Field
        nilaiRamai.innerHTML = "Nilai Ramai : "; // Set Field Labels
        createform.appendChild(nilaiRamai);

        var nilaiRamaiElement = document.createElement('input'); // Create Input Field for Name
        nilaiRamaiElement.setAttribute("type", "text");
        nilaiRamaiElement.setAttribute("name", "nilai");
        nilaiRamaiElement.setAttribute("value", nilai);
        createform.appendChild(nilaiRamaiElement);

        var messagebreak = document.createElement('br');
        createform.appendChild(messagebreak);

        var submitelement = document.createElement('input'); // Append Submit Button
        submitelement.setAttribute("type", "submit");
        submitelement.setAttribute("value", "Submit");
        createform.appendChild(submitelement);

        createform.submit();
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&libraries=geometry&callback=initMap" async defer></script>
    <div style="position: absolute; top: 30%; left: 45%;">
        <h2 style="margin-left: -19%;">Harap Menunggu</h2>
        <h3 style="margin-left: -32%;">Proses Sedang Berlangsung</h3>
    </div>
    <aside class="call-to-action bg-primary" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div id="form" style="color: black;"></div>
                </div>
            </div>
        </div>
    </aside>
  </body>
</html>