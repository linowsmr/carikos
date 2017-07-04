<?php
    $cluster = array();
    $clusterUnique = array();
    foreach ($kos as $row) {
        array_push($cluster, $row->idCluster);
    }

    $clusterUnique = array_unique($cluster);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
       #map {
        height: 100%;
        width: 100%;
       }
    </style>
    </head>
	<body>       
        <div class="col-lg-6" id="map">
            <script type="text/javascript">
                var array = [];

                function initMap() {
                    var myLatlng = new google.maps.LatLng(-7.2818645, 112.7944155);
                    var mapOptions = {
                      zoom: 14,
                      center: myLatlng
                    }
                    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                    downloadUrl("<?php echo site_url('Cluster/visualisasi') ?>", function(data) {
                        var xml = data.responseXML;
                        var markers = xml.documentElement.getElementsByTagName('cluster');
                        Array.prototype.forEach.call(markers, function(markerElem) {
                            var idKos = markerElem.getAttribute('idKos');
                            var namaKos = markerElem.getAttribute('namaKos');
                            var idCluster = markerElem.getAttribute('idCluster');
                            var point = new google.maps.LatLng(
                                parseFloat(markerElem.getAttribute('latKos')),
                                parseFloat(markerElem.getAttribute('lngKos')));
                            
                            var contentString = '<p><b>ID Kos: ' + idKos + '<br><b>Nama Kos: ' + namaKos; 
                            var infoWindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            var iconCluster1 = 'http://maps.google.com/mapfiles/kml/paddle/blu-circle.png';
                            var iconCluster2 = 'http://maps.google.com/mapfiles/kml/paddle/grn-circle.png';
                            var iconCluster3 = 'http://maps.google.com/mapfiles/kml/paddle/red-circle.png';

                            if(idCluster == '<?php echo $clusterUnique[0] ?>'){
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                    icon: iconCluster1
                                });
                            }
                            else if(idCluster == '<?php echo $clusterUnique[1] ?>'){
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                    icon: iconCluster2
                                });
                            }
                            else if(idCluster == '<?php echo $clusterUnique[2] ?>'){
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                    icon: iconCluster3
                                });
                            }
                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                            });
                        });
                    });
                    //console.log(array);
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
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap">
            </script>
        </div>
	</body>
</html>