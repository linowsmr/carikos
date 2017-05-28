<!DOCTYPE html>
<html>
<head>
	<style>
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
<script>
function initMap() {
  var origin = {lat: <?php Print($latCluster); ?>, lng: <?php Print($lngCluster); ?>};
  var destination = {lat: <?php Print($latJurusan); ?>, lng: <?php Print($lngJurusan); ?>};

  var geocoder = new google.maps.Geocoder;

  var service = new google.maps.DistanceMatrixService;
  service.getDistanceMatrix({
    origins: [origin],
    destinations: [destination],
    travelMode: google.maps.TravelMode.WALKING,
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

          form(distance);
        }
      }
    }
  });
}

function form(jarak)
{
    // Fetching HTML Elements in Variables by ID.
    var x = document.getElementById("form");
    var createform = document.createElement('form'); // Create New Element Form
    createform.setAttribute("action", "<?php echo site_url('cluster/data_jarak')?>"); // Setting Action Attribute on Form
    createform.setAttribute("method", "post"); // Setting Method Attribute on Form
    x.appendChild(createform);

    var linebreak = document.createElement('br');
    createform.appendChild(linebreak);

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

    var idJurusan = document.createElement('label'); // Create Label for Name Field
    idJurusan.innerHTML = "Jurusan ID : "; // Set Field Labels
    createform.appendChild(idJurusan);

    var idJurusanElement = document.createElement('input'); // Create Input Field for Name
    idJurusanElement.setAttribute("type", "text");
    idJurusanElement.setAttribute("name", "jurusan");
    idJurusanElement.setAttribute("value", "<?php echo $idJurusan ?>");
    createform.appendChild(idJurusanElement);

    var messagebreak = document.createElement('br');
    createform.appendChild(messagebreak);

    var jarakClusterJurusan = document.createElement('label'); // Create Label for Name Field
    jarakClusterJurusan.innerHTML = "Jarak : "; // Set Field Labels
    createform.appendChild(jarakClusterJurusan);

    var jarakClusterJurusanElement = document.createElement('input'); // Create Input Field for Name
    jarakClusterJurusanElement.setAttribute("type", "text");
    jarakClusterJurusanElement.setAttribute("name", "jarak");
    jarakClusterJurusanElement.setAttribute("value", jarak);
    createform.appendChild(jarakClusterJurusanElement);

    var messagebreak = document.createElement('br');
    createform.appendChild(messagebreak);

    var submitelement = document.createElement('input'); // Append Submit Button
    submitelement.setAttribute("type", "submit");
    submitelement.setAttribute("value", "Submit");
    createform.appendChild(submitelement);

    createform.submit();
}
</script>
<div style="position: absolute; top: 30%; left: 45%;">
    <h2 style="margin-left: -19%;">Harap Menunggu</h2>
    <h3 style="margin-left: -40%;">Proses Pendaftaran Sedang Berlangsung</h3>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap" async defer></script>
</body>
</html>
