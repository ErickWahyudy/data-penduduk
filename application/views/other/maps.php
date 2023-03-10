<!DOCTYPE html>
<html>
  <head>
    <title>Menampilkan Peta dengan Google Maps API</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
    </head>
    <body>
    <div id="map" style="width: auto; height: 500px;"></div>
    <script type="text/javascript">

        //menampilkan data json dari controller untuk ditampilkan di peta
        var data = <?php echo $data; ?>;
        var locations = [];
        for (var i = 0; i < data.length; i++) {
            locations.push([data[i].nama, data[i].latitude, data[i].longitude]);
        }
        
 
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: new google.maps.LatLng(-7.956085091087865, 111.43658349087177),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
 
      var infowindow = new google.maps.InfoWindow();
 
      var marker, i;
 
      for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
          icon: '<?= base_url('template/marker.png') ?>',
        });
 
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    </script>
    </body>
    </html>
