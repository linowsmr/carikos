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

        var kejawanSatu = [
          {lat: -7.277157, lng: 112.801971},
          {lat: -7.276793, lng: 112.802536},
          {lat: -7.281093, lng: 112.802884},
          {lat: -7.281196, lng: 112.802065},
          {lat: -7.277157, lng: 112.801971}
        ];

        var kejawanPolygon = new google.maps.Polygon({
          paths: kejawanSatu
        });

        var keputihSatu = [
  		    {lat: -7.290827, lng: 112.800078},
  		    {lat: -7.291295, lng: 112.801526},
  		    {lat: -7.292603, lng: 112.801553},
  		    {lat: -7.292646, lng: 112.801895},
  		    {lat: -7.291422, lng: 112.801997},
  		    {lat: -7.290975, lng: 112.801761},
  		    {lat: -7.290427, lng: 112.800195},
  		    {lat: -7.290827, lng: 112.800078}
  			];

			  var keputihPolygon = new google.maps.Polygon({
	        paths: keputihSatu
	      });

			  var mulyosariSatu = [
			    {lat: -7.271699, lng: 112.796779},
			    {lat: -7.270398, lng: 112.792964},
			    {lat: -7.267354, lng: 112.793061},
			    {lat: -7.267194, lng: 112.798329},
			    {lat: -7.269354, lng: 112.798705},
			    {lat: -7.269726, lng: 112.796817},
			    {lat: -7.271557, lng: 112.797203},
			    {lat: -7.271699, lng: 112.796779}
			  ];

			  var mulyosariPolygon = new google.maps.Polygon({
	        paths: mulyosariSatu
	      });
			
			  var marker = new google.maps.Marker({
			    position: {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>},
			    map: map
			  });

			  if(google.maps.geometry.poly.containsLocation(marker.getPosition(), mulyosariPolygon) == false){
				  if(google.maps.geometry.poly.containsLocation(marker.getPosition(), mulyosariPolygon) == false){
					  if(google.maps.geometry.poly.containsLocation(marker.getPosition(), mulyosariPolygon) == false){
						  form(100);
					  }
					  else{
						  form(0);
					  }
				  }
				  else{
					 form(0);
				  }
  			}
  			else{
  				form(0);
  			}
      }

      function form(nilai)
      {
        var x = document.getElementById("form");
        var createform = document.createElement('form'); // Create New Element Form
        createform.setAttribute("action", "<?php echo site_url('cluster/kos_banjir')?>"); // Setting Action Attribute on Form
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

        var nilaiBanjir = document.createElement('label'); // Create Label for Name Field
        nilaiBanjir.innerHTML = "Nilai Banjir : "; // Set Field Labels
        createform.appendChild(nilaiBanjir);

        var nilaiBanjirElement = document.createElement('input'); // Create Input Field for Name
        nilaiBanjirElement.setAttribute("type", "text");
        nilaiBanjirElement.setAttribute("name", "nilai");
        nilaiBanjirElement.setAttribute("value", nilai);
        createform.appendChild(nilaiBanjirElement);

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
        <br>
        <div class="loader"></div>
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